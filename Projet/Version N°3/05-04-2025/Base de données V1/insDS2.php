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
                $dbco->beginTransaction();

                $sql1 = "INSERT INTO utilisateurs(Nom,Prenom,Adresse,Ville,Codepostal,Mail)
                    VALUES('Nom3','Prenom3','Rue 3','Marseille',13000,'nom3@carnus.fr')";
                    $dbco->exec($sql1);

                $sql2 = "INSERT INTO utilisateurs(Nom,Prenom,Adresse,Ville,Codepostal,Mail)
                    VALUES('Nom4','Prenom4','Rue 4','Rodez',12000,'nom4@carnus.fr')";
                    $dbco->exec($sql2);

                    $dbco->commit();
                    echo 'Données ajoutées à la table ! ';
            }
            catch(PDOExecpetion $e)
                {
                    $dbco->rollBack();
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>