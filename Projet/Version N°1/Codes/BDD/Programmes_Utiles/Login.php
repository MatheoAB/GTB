<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Login.css" media="screen" type="text/css" />
    </head>

<body>
    <div id="container">
    <!-- zone de connexion -->

    <form action="Registration.php" method="POST">
        <h1>CONNEXION</h1>

    <label><b>Nom d'utilisateur :</b></label>
    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

    <label><b>Mot de passe :</b></label>
    <input type="password" placeholder="Entrer le mot de passe" name="password" required>

    <input type="submit" id='submit' value='LOGIN' >

 <!-- Connexion php. -->

<?php
    if(isset($_POST['erreur']))
        {
            $err = $_POST['erreur'];
            if($err==1 || $err==2);
        }
?>

<?php

?>

            </form>
        </div>
    </body>
</html>