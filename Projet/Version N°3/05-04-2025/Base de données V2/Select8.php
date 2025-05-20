<?php

$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'mesdonnees';

    $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

    //Requête sql pour selectionner des colonnes particulières.
    //Sélectionner les colonnes id et nom.
    $query = "SELECT * from Tableau1 where nom = ('Charles') and numero = 2024";
    $final = mysqli_query($connection, $query);

    if (mysqli_num_rows($final) > 0) 
        {
            echo "<strong>Id supérieur à 2 : </strong> <br><br>";
            while($i = mysqli_fetch_assoc($final))
            {
                echo "ID : " . $i ["id"]. " <-==-> Nom : " . $i ["nom"]. " <-==-> Numéro : " . $i ["numero"]. "<br>"; 
            }   
        echo "<br>";
        }
    else
        {
            echo "Aucun résultat !";
        }

    $query = "SELECT * from Tableau1 where nom = ('Charles')";
    $final = mysqli_query($connection, $query);

    if (mysqli_num_rows($final) > 0) 
        {
            echo "<strong>Nom = Charles : </strong> <br><br>";
            while($i = mysqli_fetch_assoc($final))
            {
                echo "ID : " . $i ["id"]. " <-==-> Nom : " . $i ["nom"]. " <-==-> Numéro : " . $i ["numero"]. "<br>"; 
            }   
        }
    else
        {
            echo "Aucun résultat !";
        }
mysqli_close($connection);
?>