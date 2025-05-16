<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAPI.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Modifier les Capteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        .sensor-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 800px;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }
        
        input, select, button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ffffff;
            text-align: center;
        }

        table th {
            background: #667eea;
        }

        .action-link {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background: #667eea;
            border-radius: 5px;
            margin: 0 5px;
            transition: background 0.3s;
        }

        .action-link:hover {
            background: #764ba2;
        }

        .back-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background: #667eea;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .back-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Sécurisation des sessions
    session_regenerate_id(true); // Régénère l'ID de session pour prévenir les attaques de fixation de session

    // Vérification si l'utilisateur est un administrateur
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrateur') {
        header('Location: Accès-Refusé.php'); // Redirection si non autorisé
        exit();
    }

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'gtb'); // Remplacez par vos informations
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . htmlspecialchars($conn->connect_error));
    }

    // Initialisation des variables de recherche
    $searchColumn = isset($_POST['searchColumn']) ? $_POST['searchColumn'] : '';
    $searchValue = isset($_POST['searchValue']) ? $_POST['searchValue'] : '';

    // Construction dynamique de la requête SQL en fonction des critères de recherche
    $sql = "SELECT id, identifiant_lorawan, type, batiment_id FROM capteurs";
    if (!empty($searchColumn) && !empty($searchValue)) {
        $sql .= " WHERE $searchColumn LIKE ?";
    }

    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur dans la requête SQL : " . htmlspecialchars($conn->error));
    }

    if (!empty($searchColumn) && !empty($searchValue)) {
        $likeValue = '%' . $searchValue . '%';
        $stmt->bind_param('s', $likeValue);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <div class="sensor-container">
        <h1>Modifier les Capteurs</h1>

        <!-- Formulaire de tri -->
        <form method="POST" action="">
            <label for="searchColumn">Trier par :</label>
            <select name="searchColumn" id="searchColumn" required>
                <option value="" disabled selected>Choisissez une option</option>
                <option value="identifiant_lorawan" <?php echo $searchColumn === 'identifiant_lorawan' ? 'selected' : ''; ?>>Identifiant LoRaWAN</option>
                <option value="type" <?php echo $searchColumn === 'type' ? 'selected' : ''; ?>>Type</option>
                <option value="batiment_id" <?php echo $searchColumn === 'batiment_id' ? 'selected' : ''; ?>>ID Bâtiment</option>
            </select>
            <input type="text" name="searchValue" placeholder="Valeur à rechercher" value="<?php echo htmlspecialchars($searchValue); ?>" required>
            <button type="submit">Rechercher</button>
        </form>

        <!-- Tableau des capteurs -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identifiant LoRaWAN</th>
                    <th>Type</th>
                    <th>ID Bâtiment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['identifiant_lorawan']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['batiment_id']); ?></td>
                            <td>
                                <a href="ModifierCapteur.php?id=<?php echo urlencode($row['id']); ?>" class="action-link">Modifier</a>
                                <a href="SupprimerCapteur.php?id=<?php echo urlencode($row['id']); ?>" class="action-link" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce capteur ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucun capteur trouvé pour ces critères.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="Choix.php" class="back-link">Retour aux Options</a>
    </div>
    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>