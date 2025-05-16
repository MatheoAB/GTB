<?php
    $server_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $database_name = 'mesdonnees';

        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        //Requête sql pour selectionner des colonnes particulières.
        //Sélectionner les colonnes id et nom.
        $query = "SELECT id,nom from Tableau1 ORDER BY nom desc";
        $final = mysqli_query($connection, $query);

        if (mysqli_num_rows($final) > 0) 
            {
                echo "<strong>Noms classés par ordre décroissant ! </strong> <br><br>";
                while($i = mysqli_fetch_assoc($final))
                {
                    echo "ID : " . $i ["id"]. " <-==-> Nom : " . $i ["nom"]. "<br>"; 
                }   
            }
        else
            {
                echo "Aucun résultat !";
            }
mysqli_close($connection);
?>