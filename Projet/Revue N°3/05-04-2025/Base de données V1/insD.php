<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajout informations Table.</title>
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
                
                $sql = "INSERT INTO utilisateurs(Nom,Prenom,Adresse,Ville,Codepostal,Mail)
                    VALUES('Carnus','Thierry','Avenue de Bourran','Rodez',12000,'lycee@carnus.fr')";
                
                $dbco->exec($sql);
                echo 'Données ajoutées à la table ! ';
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>