<?php
$servername = "XXXXXX";
$username = "XXXXXX"; // Remplacez par votre nom d'utilisateur MySQL
$password = "XXXXXX"; // Remplacez par votre mot de passe MySQL

// Connexion au serveur MySQL
$conn = new mysqli($servername, $username, $password);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Liste des bases de données à créer
$databases = ["ecole", "gymnase", "mairie"];

foreach ($databases as $db) {
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    if ($conn->query($sql) === TRUE) {
        echo "Base de données '$db' créée avec succès.<br>";
    } else {
        echo "Erreur lors de la création de la base '$db' : " . $conn->error . "<br>";
    }
}

// Fermer la connexion
$conn->close();
?>
