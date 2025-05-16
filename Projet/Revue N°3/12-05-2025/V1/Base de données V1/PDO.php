<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création DATA BASE.</title>
</head>
<body>
    <h1>Bases de données</h1>
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    try
    {
        $dbco = new PDO("mysql:host=$servername",$username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE pdodonnées";
        $dbco->exec($sql);
        echo 'Base de données créée avec succès';
    }
    catch(PDOExecpetion $e)
        {
            echo "Erreur : " . $e->getMessage();
        }
    ?>
    
</body>
</html>