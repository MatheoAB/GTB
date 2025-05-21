<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Base de donnée supprimée !</title>
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

                $sql = "DROP DATABASE pdodonnées";
                $dbco->exec($sql);
                echo 'Base de données supprimée avec succès !';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>