<?php
        $server_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $database_name = 'mesdonnees';
        
        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        $query = "INSERT INTO Tableau1 (id, nom, numero) VALUES (1, 'Carnus',12)";
        if (mysqli_query($connection,$query)) 
            {
                echo "Enregistrement effectué avec succès !";
            }
        else
            {
                echo "Erreur : " . mysqli_error($connection);
            }
mysqli_close($connection);
?>