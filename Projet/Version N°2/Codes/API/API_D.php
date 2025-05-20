<?php
// Définir les entêtes pour les réponses JSON
header('Content-Type: application/json');

// Charger les variables d'environnement depuis .env
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

// Configuration Base de données
$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur de connexion à la base de données: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit;
}

// Créer les tables si elles n'existent pas
createTablesIfNotExist($pdo);

// Routage des requêtes
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Routes API
if ($requestMethod === 'GET') {
    if (preg_match('/\/api\/sync-data$/', $requestUri)) {
        handleSyncData($pdo);
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

// Fonction pour créer les tables si elles n'existent pas
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
            error_log("Erreur lors de la création des tables: " . $e->getMessage());
        }
    }
}

// Fonction pour récupérer les données de ChirpStack
function getChirpstackData() {
    global $chirpstackApiUrl, $chirpstackApiToken;

    $headers = [
        'Authorization: Bearer ' . $chirpstackApiToken,
        'Content-Type: application/json'
    ];

    // Récupérer la liste des appareils
    $ch = curl_init($chirpstackApiUrl . '/api/devices');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        error_log("Erreur lors de la récupération des appareils: " . $response);
        return null;
    }

    $devicesData = json_decode($response, true);
    $result = [];

    // Pour chaque appareil, récupérer les dernières données
    foreach ($devicesData['result'] as $device) {
        $devEui = $device['devEui'];

        // Récupérer les dernières données de l'appareil
        $ch = curl_init($chirpstackApiUrl . '/api/devices/' . $devEui . '/data');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $deviceDataResponse = curl_exec($ch);
        $deviceDataHttpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($deviceDataHttpcode === 200) {
            $deviceData = json_decode($deviceDataResponse, true);

            // Ajouter les informations du capteur et ses données
            $deviceInfo = [
                'dev_eui' => $devEui,
                'nom' => $device['name'] ?? 'Inconnu',
                'type' => $device['deviceProfileName'] ?? 'Inconnu',
                'localisation' => $device['location']['description'] ?? 'Inconnue',
                'dernier_message' => date('Y-m-d H:i:s'),
                'variables' => []
            ];

            // Traiter les données des capteurs
            if (isset($deviceData['result']) && count($deviceData['result']) > 0) {
                $latestData = $deviceData['result'][0];

                // Supposons que les données sont dans le format JSON
                $payload = json_decode($latestData['data'] ?? '{}', true);

                // Extraire les variables
                foreach ($payload as $key => $value) {
                    if (is_numeric($value)) {
                        $deviceInfo['variables'][] = [
                            'nom' => $key,
                            'valeur' => (float) $value,
                            'unite' => 'N/A',  // À adapter selon vos besoins
                            'timestamp' => $latestData['timestamp'] ?? date('Y-m-d H:i:s')
                        ];
                    }
                }
            }

            $result[] = $deviceInfo;
        } else {
            error_log("Erreur lors de la récupération des données pour $devEui: " . $deviceDataResponse);
        }
    }

    return $result;
}

// Fonction pour gérer la synchronisation des données
function handleSyncData($pdo) {
    try {
        $pdo->beginTransaction();

        // Récupérer les données de ChirpStack
        $devicesData = getChirpstackData();

        if (!$devicesData) {
            http_response_code(500);
            echo json_encode(['error' => 'Impossible de récupérer les données de ChirpStack']);
            return;
        }

        // Compteurs pour le rapport
        $devicesCount = 0;
        $variablesCount = 0;

        // Traiter chaque appareil
        foreach ($devicesData as $device) {
            $devEui = $device['dev_eui'];

            // Vérifier si le capteur existe déjà
            $stmt = $pdo->prepare("SELECT id FROM capteurs WHERE dev_eui = ?");
            $stmt->execute([$devEui]);
            $existingDevice = $stmt->fetch();

            if ($existingDevice) {
                $capteurId = $existingDevice['id'];
                // Mettre à jour le capteur
                $updateStmt = $pdo->prepare("UPDATE capteurs SET dernier_message = ? WHERE id = ?");
                $updateStmt->execute([date('Y-m-d H:i:s'), $capteurId]);
            } else {
                // Insérer un nouveau capteur
                $insertStmt = $pdo->prepare(
                    "INSERT INTO capteurs (dev_eui, nom, type, localisation, date_ajout, dernier_message) 
                     VALUES (?, ?, ?, ?, ?, ?)"
                );
                $insertStmt->execute([
                    $devEui,
                    $device['nom'],
                    $device['type'],
                    $device['localisation'],
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s')
                ]);
                $capteurId = $pdo->lastInsertId();

                // Ajouter un log pour le nouveau capteur
                $logStmt = $pdo->prepare(
                    "INSERT INTO logs (capteur_id, message, niveau, timestamp) 
                     VALUES (?, ?, ?, ?)"
                );
                $logStmt->execute([
                    $capteurId,
                    "Nouveau capteur ajouté: " . $device['nom'] . " (" . $devEui . ")",
                    "INFO",
                    date('Y-m-d H:i:s')
                ]);
            }

            $devicesCount++;

            // Traiter les variables du capteur
            foreach ($device['variables'] as $variable) {
                $timestamp = is_string($variable['timestamp']) 
                    ? date('Y-m-d H:i:s', strtotime($variable['timestamp'])) 
                    : date('Y-m-d H:i:s');

                $variableStmt = $pdo->prepare(
                    "INSERT INTO variables (capteur_id, nom, valeur, unite, timestamp) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                $variableStmt->execute([
                    $capteurId,
                    $variable['nom'],
                    $variable['valeur'],
                    $variable['unite'],
                    $timestamp
                ]);
                $variablesCount++;
            }
        }

        // Valider les modifications
        $pdo->commit();

        echo json_encode([
            'success' => true,
            'message' => "Synchronisation réussie. $devicesCount capteurs et $variablesCount variables mis à jour."
        ]);

    } catch (Exception $e) {
        // En cas d'erreur, annuler les modifications
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Journaliser l'erreur
        try {
            $errorLogStmt = $pdo->prepare(
                "INSERT INTO logs (capteur_id, message, niveau, timestamp) 
                 VALUES (?, ?, ?, ?)"
            );
            $errorLogStmt->execute([
                null,
                "Erreur lors de la synchronisation: " . $e->getMessage(),
                "ERROR",
                date('Y-m-d H:i:s')
            ]);
        } catch (Exception $logException) {
            error_log("Erreur lors de la journalisation de l'erreur: " . $logException->getMessage());
        }

        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Fonction pour récupérer tous les capteurs
function handleGetCapteurs($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM capteurs");
        $capteurs = $stmt->fetchAll();

        $result = [];
        foreach ($capteurs as $capteur) {
            $result[] = [
                'id' => $capteur['id'],
                'dev_eui' => $capteur['dev_eui'],
                'nom' => $capteur['nom'],
                'type' => $capteur['type'],
                'localisation' => $capteur['localisation'],
                'date_ajout' => $capteur['date_ajout'],
                'dernier_message' => $capteur['dernier_message']
            ];
        }

        echo json_encode($result);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function handleGetVariables($pdo, $capteurId) {
    try {
        // Vérifier si le capteur existe
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM capteurs WHERE id = ?");
        $checkStmt->execute([$capteurId]);
        $count = $checkStmt->fetchColumn();

        if ($count == 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Capteur non trouvé']);
            return;
        }

        // Récupérer les dernières valeurs de chaque variable pour ce capteur
        $stmt = $pdo->prepare(
            "SELECT v.* FROM variables v
             JOIN (
                SELECT nom, MAX(timestamp) as max_timestamp
                FROM variables
                WHERE capteur_id = ?
                GROUP BY nom
             ) latest ON v.nom = latest.nom AND v.timestamp = latest.max_timestamp
             WHERE v.capteur_id = ?
             ORDER BY v.nom"
        );
        $stmt->execute([$capteurId, $capteurId]);
        $variables = $stmt->fetchAll();

        echo json_encode($variables);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}