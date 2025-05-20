<?php
$serveur = "172.40.20.145";
$username = "gtb@btscarnus.fr";
$passwdr = "zB9GOsrcZrpI0D";
$dbname = "chirpstack";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $username, $passwdr, $dbname);

// Vérification de la connexion
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Exécution de la requête
$requete1 = 'SELECT * FROM device';
$resultat1 = mysqli_query($connexion, $requete1);

if (!$resultat1) {
    die("La requête n'a pas réussi : " . mysqli_error($connexion));
}

// Récupération d'une ligne
$data1 = mysqli_fetch_array($resultat1, MYSQLI_ASSOC);

// Encodage en JSON
echo json_encode($data1);

// Fermeture de la connexion
mysqli_close($connexion);
?>