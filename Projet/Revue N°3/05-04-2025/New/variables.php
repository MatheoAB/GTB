<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
</head>
<body>
    <?php
        $servername = '172.40.1.145';
        $dbname = 'mairie';
        $user = 'test';
        $pass = 'rgEh9B95';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
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
                echo 'La table a été créée avec succès !';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>