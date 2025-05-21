<?php

/* Filtrage des données de la table MySQL avec l'instruction WHERE.

WHERE est utilisée pour extraire uniquement les enregistrements qui correspondent à une condition spécifique.
WHERE vérifiera la condition en prenant un opérateur suivi d'une valeur.

Dans ce code, on va sélectionner toutes les colonnes de la table "Tableau1"dont la valeur id est supérieure à 3 et ensuite afficher le résultat.

Ains, l'opérateur sera supérieur à (">") et la valeur est 3 en spécifiant le nom de la colonne (column_name) comme nom.
*/

    $server_name = 'XXXXXX';
    $user_name = 'XXXXXX';
    $password = 'XXXXXX';
    $database_name = 'XXXXXX';

        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        //Requête sql pour selectionner des colonnes particulières.
        //Sélectionner les colonnes id et nom.
        $query = "SELECT * from Tableau1 where nom = 'Lycée'";
        $final = mysqli_query($connection, $query);

        if (mysqli_num_rows($final) > 0) 
            {
                echo "<strong>Nom 'Lycée' :</strong> <br><br>";
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