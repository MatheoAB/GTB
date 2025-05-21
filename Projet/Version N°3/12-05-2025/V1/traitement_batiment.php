<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    $servername = "XXXXXX";
    $username = "XXXXXX";
    $password = "XXXXXX";
    $dbname = "XXXXXX";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("<div class='error'>Erreur de connexion : " . $conn->connect_error . "</div>");
    }

    // Récupération des champs du formulaire
    $statut = $_POST['Statut'] ?? '';
    $nom = $_POST['Nom'] ?? '';
    $nombre = intval($_POST['Nombre'] ?? 0);

    // Sécurité : requêtes préparées
    $stmt_bat = $conn->prepare("INSERT INTO batiment (type, nom) VALUES (?, ?)");
    $stmt_bat->bind_param("ss", $statut, $nom);

    if ($stmt_bat->execute()) {
        $batiment_id = $conn->insert_id; // ID du bâtiment inséré

        // Pour chaque capteur sélectionné, insérer dans la table capteurs
        $stmt_capteur = $conn->prepare("INSERT INTO capteurs (batiment_id, type_capteur) VALUES (?, ?)");
        for ($i = 1; $i <= $nombre; $i++) {
            $capteur_type = $_POST["sensor-$i"] ?? '';
            if (in_array($capteur_type, ['temperature', 'humidity', 'co2'])) {
                $stmt_capteur->bind_param("is", $batiment_id, $capteur_type);
                $stmt_capteur->execute();
            }
        }
        $stmt_capteur->close();

        echo "<div class='success'>Le bâtiment et ses capteurs ont été ajoutés avec succès.</div>";
    } else {
        echo "<div class='error'>Erreur : " . $conn->error . "</div>";
    }

    $stmt_bat->close();
    $conn->close();
}
?>