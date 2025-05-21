<?php
    $server_name = 'XXXXXX';
    $user_name = 'XXXXXX';
    $password = 'XXXXXX';
    $database_name = 'XXXXXX';

        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        //Requête sql pour selectionner des colonnes particulières.
        //Sélectionner les colonnes id et nom.
        $query = "SELECT * from Tableau1";
        $final = mysqli_query($connection, $query);

        if (mysqli_num_rows($final) > 0) 
            {
                while($i = mysqli_fetch_assoc($final))
                echo "ID : " . $i ["id"]. " &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp Nom : " . $i ["nom"]. " &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp Numéro : " . $i ["numero"]. "<br>"; 
            }
        else
            {
                echo "Aucun résultat !";
            }
mysqli_close($connection);
?>