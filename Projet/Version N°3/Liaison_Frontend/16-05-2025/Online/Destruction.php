<?php
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL

// Connexion au serveur MySQL
$conn = new mysqli($servername, $username, $password);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer la liste des bases de données
$result = $conn->query("SHOW DATABASES");

while ($row = $result->fetch_assoc()) {
    $dbName = $row['Database'];
    // Ignorer les bases de données système
    if (!in_array($dbName, ["information_schema", "mysql", "performance_schema", "sys"])) {
        $sql = "DROP DATABASE `$dbName`";
        if ($conn->query($sql) === TRUE) {
            echo "Base de données '$dbName' supprimée avec succès.<br>";
        } else {
            echo "Erreur lors de la suppression de la base '$dbName' : " . $conn->error . "<br>";
        }
    }
}

// Fermer la connexion
$conn->close();
?>