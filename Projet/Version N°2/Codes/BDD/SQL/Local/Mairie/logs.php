<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
</head>
<body>
    <?php
        $servername = 'XXXXXX';
        $dbname = 'mairie';
        $user = 'XXXXXX';
        $pass = 'XXXXXX';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                $sql = "CREATE TABLE logs (
                    ID int(11) NOT NULL,
                    Connexions varchar(20) NOT NULL,
                    Modifications varchar(100) NOT NULL,
                    Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                    
                INSERT INTO logs (ID, Connexions, Modifications, Date) VALUES
(4, 'Administrateur', 'Mise en place d\'un nouveau capteur de température LMT85 + Ajout d\'un programme de test.', '2025-03-11 15:53:07')";

                $dbco->exec($sql);
                echo 'La table a été créée avec succès !';
            }


            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>