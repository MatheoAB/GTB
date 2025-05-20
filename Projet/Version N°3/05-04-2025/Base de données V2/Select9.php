<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="#" method="POST">

        <input type="text" class="box-input" name="nom" placeholder="Entrez votre nom." required minlength="3" maxlength="20"/>
        
        <br>
        <input type="text" class="box-input" name="numero" placeholder="Entrez votre numéro." required minlength="3" maxlength="20"/>

        <br><br>
        <input type="submit" name="submit" value="Valider" class="box-button">
        <br><br>
    </form>
</body>
</html>

<?php

$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'mesdonnees';

$nom = $_POST["nom"];
$numero = $_POST["numero"];
  
    //Requête sql pour selectionner des colonnes particulières.
    //Sélectionner les colonnes id et nom.
        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        $query = "SELECT * from Tableau1 where nom = '$nom' and numero = '$numero'";
        $final = mysqli_query($connection, $query);

    if (mysqli_num_rows($final) > 0) 
        {
            while($i = mysqli_fetch_assoc($final))
            {
                echo "Bienvenue $nom !";
                echo "<br>";
            }   
        echo "<br>";
        }
    else
        {
            echo "Accès refusé !";
        }

mysqli_close($connection);

?>