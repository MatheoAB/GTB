<?php
header('Content-Type: application/json');

// Charger les variables d’environnement
if (file_exists('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Configuration ChirpStack
$chirpstackApiUrl = getenv('CHIRPSTACK_API_URL');
$chirpstackApiToken = getenv('CHIRPSTACK_API_TOKEN');

// Connexion MariaDB
try {
    $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur MariaDB : " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Connexion MariaDB échouée']);
    exit;
}

// Connexion PostgreSQL
try {
    $pgPdo = new PDO("pgsql:host=" . getenv('PG_HOST') . ";dbname=" . getenv('PG_DB'), getenv('PG_USER'), getenv('PG_PASS'));
    $pgPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pgPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur PostgreSQL : " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Connexion PostgreSQL échouée']);
    exit;
}

// Créer les tables si nécessaire
createTablesIfNotExist($pdo);

// Routage
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'GET') {
    if (preg_match('/\/api\/sync-data$/', $requestUri)) {
        handleSyncData($pdo, $pgPdo);
    } elseif (preg_match('/\/api\/capteurs$/', $requestUri)) {
        handleGetCapteurs($pdo);
    } elseif (preg_match('/\/api\/capteurs\/(\d+)\/variables$/', $requestUri, $matches)) {
        handleGetVariables($pdo, $matches[1]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint non trouvé']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
}

// --- Fonctions ---

function createTablesIfNotExist($pdo) {
    $queries = [
        "CREATE TABLE IF NOT EXISTS capteurs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            dev_eui VARCHAR(16) UNIQUE,
            nom VARCHAR(100),
            type VARCHAR(50),
            localisation VARCHAR(255),
            date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
            dernier_message DATETIME
        )",
        "CREATE TABLE IF NOT EXISTS variables (
            id INT AUTO_INCREMENT PRIMARY KEY,
            capteur_id INT,
            nom VARCHAR(100),
            valeur FLOAT,
            unite VARCHAR(20),
            timestamp DATETIME,
            FOREIGN KEY (capteur_id) REFERENCES capteurs(id)
        )",
        "CREATE TABLE IF NOT EXISTS logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            capteur_id INT,
            message TEXT,
            niveau VARCHAR(20),
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (capteur_id) REFERENCES capteurs(id)
        )"
    ];
    foreach ($queries as $query) {
        try {
            $pdo->exec($query);
        } catch (PDOException $e) {
            error_log("Erreur table : " . $e->getMessage());
        }
    }
}

function handleSyncData($pdo, $pgPdo) {
    try {
        $pdo->beginTransaction();

        // 🔁 Transfert des données PostgreSQL vers MariaDB
        transferFromPostgresToMaria($pgPdo, $pdo);

        // 🔁 Données depuis ChirpStack
        $devicesData = getChirpstackData();
        if (!$devicesData) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur récupération ChirpStack']);
            return;
        }

        $devicesCount = 0;
        $variablesCount = 0;

        foreach ($devicesData as $device) {
            $stmt = $pdo->prepare("SELECT id FROM capteurs WHERE dev_eui = ?");
            $stmt->execute([$device['dev_eui']]);
            $existingDevice = $stmt->fetch();

            if ($existingDevice) {
                $capteurId = $existingDevice['id'];
                $pdo->prepare("UPDATE capteurs SET dernier_message = ? WHERE id = ?")
                    ->execute([date('Y-m-d H:i:s'), $capteurId]);
            } else {
                $pdo->prepare("INSERT INTO capteurs (dev_eui, nom, type, localisation, date_ajout, dernier_message)
                    VALUES (?, ?, ?, ?, ?, ?)")
                    ->execute([
                        $device['dev_eui'], $device['nom'], $device['type'],
                        $device['localisation'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s')
                    ]);
                $capteurId = $pdo->lastInsertId();
            }

            foreach ($device['variables'] as $variable) {
                $pdo->prepare("INSERT INTO variables (capteur_id, nom, valeur, unite, timestamp)
                    VALUES (?, ?, ?, ?, ?)")
                    ->execute([
                        $capteurId, $variable['nom'], $variable['valeur'],
                        $variable['unite'], $variable['timestamp']
                    ]);
                $variablesCount++;
            }

            $devicesCount++;
        }

        $pdo->commit();

        echo json_encode([
            'success' => true,
            'message' => "$devicesCount capteurs et $variablesCount variables synchronisés"
        ]);
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function transferFromPostgresToMaria($pgPdo, $mariaPdo) {
    $stmt = $pgPdo->query("SELECT * FROM capteurs");
    $capteurs = $stmt->fetchAll();

    foreach ($capteurs as $capteur) {
        $check = $mariaPdo->prepare("SELECT COUNT(*) FROM capteurs WHERE dev_eui = ?");
        $check->execute([$capteur['dev_eui']]);

        if ($check->fetchColumn() == 0) {
            $insert = $mariaPdo->prepare("INSERT INTO capteurs (dev_eui, nom, type, localisation, date_ajout, dernier_message)
                VALUES (?, ?, ?, ?, ?, ?)");
            $insert->execute([
                $capteur['dev_eui'], $capteur['nom'], $capteur['type'],
                $capteur['localisation'], $capteur['date_ajout'], $capteur['dernier_message']
            ]);
        }
    }
}

function getChirpstackData() {
    global $chirpstackApiUrl, $chirpstackApiToken;
    $headers = ['Authorization: Bearer ' . $chirpstackApiToken, 'Content-Type: application/json'];

    $ch = curl_init($chirpstackApiUrl . '/api/devices');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) return null;

    $devicesData = json_decode($response, true);
    $result = [];

    foreach ($devicesData['result'] ?? [] as $device) {
        $devEui = $device['devEui'];
        $deviceInfo = [
            'dev_eui' => $devEui,
            'nom' => $device['name'] ?? 'Inconnu',
            'type' => $device['deviceProfileName'] ?? 'Inconnu',
            'localisation' => $device['location']['description'] ?? 'Inconnue',
            'dernier_message' => date('Y-m-d H:i:s'),
            'variables' => []
        ];

        $ch = curl_init($chirpstackApiUrl . "/api/devices/$devEui/data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $deviceData = curl_exec($ch);
        curl_close($ch);

        $dataDecoded = json_decode($deviceData, true);
        $latestData = $dataDecoded['result'][0] ?? null;

        if ($latestData && isset($latestData['data'])) {
            $payload = json_decode($latestData['data'], true);
            foreach ($payload as $key => $val) {
                if (is_numeric($val)) {
                    $deviceInfo['variables'][] = [
                        'nom' => $key,
                        'valeur' => (float)$val,
                        'unite' => 'N/A',
                        'timestamp' => $latestData['timestamp'] ?? date('Y-m-d H:i:s')
                    ];
                }
            }
        }

        $result[] = $deviceInfo;
    }

    return $result;
}

function handleGetCapteurs($pdo) {
    $stmt = $pdo->query("SELECT * FROM capteurs");
    echo json_encode($stmt->fetchAll());
}

function handleGetVariables($pdo, $capteurId) {
    $stmt = $pdo->prepare(
        "SELECT v.* FROM variables v
         JOIN (
            SELECT nom, MAX(timestamp) AS max_ts FROM variables
            WHERE capteur_id = ? GROUP BY nom
         ) latest ON v.nom = latest.nom AND v.timestamp = latest.max_ts
         WHERE v.capteur_id = ?
         ORDER BY v.nom"
    );
    $stmt->execute([$capteurId, $capteurId]);
    echo json_encode($stmt->fetchAll());
}