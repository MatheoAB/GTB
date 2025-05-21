<?php
        $servername = 'XXXXXX';
        $dbname = 'XXXXXX';
        $user = 'XXXXXX';
        $pass = 'XXXXXX';
        
        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);

        $query = "INSERT INTO connexions (ID, Nom, Mdp, Statut, Code, Date) VALUES (2, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Admin', '235649', '2025-03-10 13:29:44')";
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