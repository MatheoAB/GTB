<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
</head>
<body>
    <?php
    $host = 'localhost';
    $dbname = 'Ecole';
    $username = 'root';
    $password = '';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
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
   
    Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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