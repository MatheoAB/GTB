<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BTS CIEL - PHP/BDD</title>
</head>
<body>
    <?php
        $servername = 'XXXXXX';
        $dbname = 'XXXXXX';
        $user = 'XXXXXX';
        $pass = 'XXXXXX';

        try
            {
                $dbco= new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = "ALTER TABLE utilisateurs ADD Date TIMESTAMP";
                $dbco->exec($sql);
                echo 'Colonne ajoutée avec succès !';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>