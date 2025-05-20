<?php
header("Content-Type: application/json"); // Déclare que l'API retourne des données JSON

// Configuration de la base de données PostgreSQL
$dbHost = "172.40.20.145";
$dbPort = "8080";
$dbName = "chripstack";
$dbUser = "gtb@btscarnus.fr";
$dbPassword = "zB9GOsrcZrpI0D";

try {
    // Connexion à PostgreSQL
    $pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Gestion des actions API
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    if ($action === "getData") {
        // Récupérer les données de la table
        $stmt = $pdo->query("SELECT id, name, description FROM example_table");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "success" => true,
            "data" => $data
        ]);
    } elseif ($action === "addData") {
        // Ajouter des données à la table
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;

        if ($name && $description) {
            $stmt = $pdo->prepare("INSERT INTO example_table (name, description) VALUES (:name, :description)");
            $stmt->execute(['name' => $name, 'description' => $description]);

            echo json_encode([
                "success" => true,
                "message" => "Données ajoutées avec succès."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Les champs 'name' et 'description' sont requis."
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Action non reconnue."
        ]);
    }
} catch (PDOException $e) {
    // Gestion des erreurs de connexion ou d'exécution
    echo json_encode([
        "success" => false,
        "message" => "Erreur de la base de données : " . $e->getMessage()
    ]);
}