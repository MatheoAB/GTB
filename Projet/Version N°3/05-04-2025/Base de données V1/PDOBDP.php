<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Table de données.</title>
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
                
                $sql = "CREATE TABLE Utilisateurs(
                    Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    Nom VARCHAR(30) NOT NULL,
                    Prenom VARCHAR(30) NOT NULL,
                    Adresse VARCHAR(70) NOT NULL,
                    Ville VARCHAR(30) NOT NULL,
                    Codepostal INT UNSIGNED NOT NULL,
                    Mail VARCHAR(50) NOT NULL,
                    UNIQUE(Mail))";
                
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