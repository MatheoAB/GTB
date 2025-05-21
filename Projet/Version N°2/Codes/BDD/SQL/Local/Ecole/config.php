<?php
// Informations d'identification
define('DB_SERVER', 'XXXXXX');
define('DB_USERNAME', 'XXXXXX');
define('DB_PASSWORD', '');
define('DB_NAME', 'XXXXXX');
 
// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// V�rification de la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>