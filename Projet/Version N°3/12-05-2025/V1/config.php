<?php
// Informations d'identification
define('DB_SERVER', '172.40.1.145');
define('DB_USERNAME', 'test');
define('DB_PASSWORD', 'rgEh9B95');
define('DB_NAME', 'mairie');
 
// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// V�rification de la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>