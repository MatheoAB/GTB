<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BTS CIEL - PHP/BDD</title>
</head>
<body>
    <?php
        $servername = 'localhost';
        $dbname = 'pdodonnées';
        $user = 'root';
        $pass = '';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = "ALTER TABLE utilisateurs DROP COLUMN DATE";
                $dbco->exec($sql);
                echo 'Colonne suppprimée avec succès !';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>