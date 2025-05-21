<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
</head>
<body>
    <?php
    $host = 'XXXXXX';
    $dbname = 'Ecole';
    $username = 'XXXXXX';
    $password = 'XXXXXX';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                $sql = "CREATE TABLE connexions (
                    ID int(11) NOT NULL,
                    Nom varchar(30) NOT NULL,
                    Mdp varchar(100) NOT NULL,
                    Statut varchar(20) NOT NULL,
                    Code varchar(20) NOT NULL,
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