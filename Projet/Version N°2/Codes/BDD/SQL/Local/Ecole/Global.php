<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
</head>
<body>
    <?php
        $servername = 'XXXXXX';
        $dbname = 'ecole';
        $user = 'XXXXXX';
        $pass = 'XXXXXX';

        try {
            $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Création de la table
            $sql = "CREATE TABLE connexions (
                ID int(11) NOT NULL,
                Nom varchar(30) NOT NULL,
                Mdp varchar(100) NOT NULL,
                Statut varchar(20) NOT NULL,
                Code varchar(20) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
            $dbco->exec($sql);
            echo 'La table a été créée avec succès !<br>';

            // Insertion des données
            $sql = "INSERT INTO connexions (ID, Nom, Mdp, Statut, Code, Date) VALUES 
            (1, 'Test', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Admin', '235649', '2025-03-10 13:29:44')";
            $dbco->exec($sql);

            $sql = "CREATE TABLE etats (
                ID int(11) NOT NULL,
                Passerelle tinyint(1) NOT NULL,
                Connecteur tinyint(1) NOT NULL,
                CapteurT tinyint(1) NOT NULL,
                CapteurM tinyint(1) NOT NULL,
                CapteurC tinyint(1) NOT NULL,
                CapteurB tinyint(1) NOT NULL,
                AlarmeT tinyint(1) NOT NULL,
                AlarmeA tinyint(1) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
            $dbco->exec($sql);

            $sql = "CREATE TABLE logs (
                ID int(11) NOT NULL,
                Connexions varchar(20) NOT NULL,
                Modifications varchar(100) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
            $dbco->exec($sql);

            $sql = "CREATE TABLE variables (
                ID int(11) NOT NULL,
                Temp float NOT NULL,
                ConsT float NOT NULL,
                Luminosité float NOT NULL,
                ConsL float NOT NULL,
                Mouvement tinyint(1) NOT NULL,
                Eau float NOT NULL,
                Electricité float NOT NULL,
                Gaz float NOT NULL,
                Air varchar(25) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
            
            $dbco->exec($sql);
            echo 'Données insérées avec succès !';
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    ?>  
</body>
</html>
