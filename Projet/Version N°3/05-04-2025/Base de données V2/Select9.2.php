<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<?php

$server_name = 'XXXXXX';
$user_name = 'XXXXXX';
$password = 'XXXXXX';
$database_name = 'XXXXXX';

if (isset($_POST['nom']))
    {
        $nom = stripslashes($_REQUEST['nom']);
        $nom = mysqli_real_escape_string($connection, $nom);
        $numero = stripslashes($_REQUEST['numero']);
        $numero = mysqli_real_escape_string($connection, $numero);
    }
        $query = "SELECT * from Tableau1 where nom = '$nom' and numero = '$numero'";
        $final = mysqli_query($connection, $query) or die (mysqli_error());

        if (mysqli_num_rows($final) > 0) 
            {
                while($i = mysqli_fetch_assoc($final))
                {
                    echo "Bienvenue <strong> $nom </strong> !";
                    echo "<br>";
                }   
            echo "<br>";
        }
    else
        {
            echo "Accès refusé !";
        }

mysqli_close($connection);
?>

        <form action="#" method="POST">

        <input type="text" class="box-input" name="nom" placeholder="Entrez votre nom." required minlength="3" maxlength="20"/>

        <br>
        <input type="text" class="box-input" name="numero" placeholder="Entrez votre numéro." required minlength="2" maxlength="20"/>

        <br><br>
        <input type="submit" name="submit" value="Valider" class="box-button">
        <br><br>
    </form>
</body>
</html>
