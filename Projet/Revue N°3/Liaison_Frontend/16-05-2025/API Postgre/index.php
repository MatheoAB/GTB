<?php
// Définir l'en-tête pour les réponses JSON dans le mode API
if (isset($_GET['action']) && $_GET['action'] === 'getData') {
    header("Content-Type: application/json");

    // Configuration de la base de données PostgreSQL
    $dbHost = "172.40.20.145";
    $dbPort = "9010";
    $dbUser = "Smica";
    $dbPassword = "CIEL12000";

    try {
        // Connexion à PostgreSQL
        $pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données de la table
        $stmt = $pdo->query("SELECT id, name, description FROM example_table");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les données sous forme de JSON
        echo json_encode([
            "success" => true,
            "data" => $data
        ]);
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion ou d'exécution
        echo json_encode([
            "success" => false,
            "message" => "Erreur de la base de données : " . $e->getMessage()
        ]);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Frontend</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #dataDisplay {
            margin-top: 20px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Données de l'API</h1>
        <button id="loadData">Charger les Données</button>
        <div id="dataDisplay"></div>
    </div>
    <script>
        document.getElementById("loadData").addEventListener("click", function () {
            // Appeler l'API pour récupérer les données
            fetch("index.php?action=getData")
                .then(response => response.json())
                .then(data => {
                    const display = document.getElementById("dataDisplay");
                    display.innerHTML = ""; // Réinitialiser l'affichage

                    if (data.success) {
                        // Construire un tableau des données
                        const table = document.createElement("table");
                        const headerRow = document.createElement("tr");

                        // En-têtes du tableau
                        ["ID", "Nom", "Description"].forEach(header => {
                            const th = document.createElement("th");
                            th.textContent = header;
                            headerRow.appendChild(th);
                        });

                        table.appendChild(headerRow);

                        // Ajouter des lignes de données
                        data.data.forEach(row => {
                            const tr = document.createElement("tr");
                            Object.values(row).forEach(cellData => {
                                const td = document.createElement("td");
                                td.textContent = cellData;
                                tr.appendChild(td);
                            });
                            table.appendChild(tr);
                        });

                        display.appendChild(table);
                    } else {
                        display.textContent = data.message;
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des données :", error);
                    document.getElementById("dataDisplay").textContent = "Erreur lors de la récupération des données.";
                });
        });
    </script>
</body>
</html>