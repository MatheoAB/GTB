<!DOCTYPE html>
<html>
    <head>
        <title>Suppression Table</title>
        <meta charset='utf-8'>
    </head>
<body>
    <h1>Table.</h1> 
    
    <?php
        $servname = "localhost";
        $dbname = "pdodonnées";
        $user = "root";
        $pass = "";
            try
                {
                    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                    $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql = "DROP TABLE utilisateurs";
                    $dbco->exec($sql);
                    echo 'Table bien supprimée';
                }

                catch(PDOException $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>
</body