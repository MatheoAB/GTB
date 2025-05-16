<?php
    $server_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $database_name = 'mesdonnees';

        $connection = mysqli_connect($server_name, $user_name, $password, $database_name);

        $query = "INSERT INTO Tableau1 (id, nom, numero) VALUES (2, 'Charles',2023);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (5, 'Ville de Rodez',1120);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (3, 'Lycée',20);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (4, 'Informatique',100);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (6, 'Réseaux',200);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (7, 'Charles',2024);";
        $query .= "INSERT INTO Tableau1 (id, nom, numero) VALUES (8, 'Charles',2024)";

        if (mysqli_multi_query($connection,$query)) 
            {
                echo "Enregistrement effectué avec succès !";
            }
        else
            {
                echo "Erreur : " . mysqli_error($connection);
            }
mysqli_close($connection);
?>