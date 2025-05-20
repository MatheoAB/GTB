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
                
                $sql1 = "INSERT INTO utilisateurs(Nom,Prenom,Adresse,Ville,Codepostal,Mail)
                    VALUES('Nom1','Prenom1','Rue 1','Toulouse',31000,'nom1@carnus.fr')";
                    $dbco->exec($sql1);

                $sql2 = "INSERT INTO utilisateurs(Nom,Prenom,Adresse,Ville,Codepostal,Mail)
                VALUES('Nom2','Prenom2','Rue 2','Paris',75000,'nom2@carnus.fr')";
                    $dbco->exec($sql2);
                
                echo 'Données ajoutées à la table ! ';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>