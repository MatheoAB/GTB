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

                $sth = $dbco->prepare("UPDATE utilisateurs SET Mail='prenom2.nom2@carnus.fr' WHERE Id=3");
                $sth = $dbco->prepare("UPDATE utilisateurs SET Mail='prenom3.nom3@carnus.fr' WHERE Id=4");
                $sth = $dbco->prepare("UPDATE utilisateurs SET Mail='prenom4.nom4@carnus.fr' WHERE Id=5");
                
                $sth->execute();
                $count = $sth->rowCount();
                print('Mise à jour de ' .$count. 'entrée(s)');
            }
            catch(PDOExecpetion $e)
                {
                    echo "Erreur : " . $e->getMessage();
                }
    ?>  
</body>
</html>