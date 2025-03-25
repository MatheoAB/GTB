<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<?php
	require('config.php');
	if (isset($_REQUEST['Nom'], $_REQUEST['Mdp'], $_REQUEST['Statut'], $_REQUEST['Code'])){
		// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
		$Nom = stripslashes($_REQUEST['Nom']);
		$Nom = mysqli_real_escape_string($conn, $Nom); 
		// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$Mdp = stripslashes($_REQUEST['Mdp']);
		$Mdp = mysqli_real_escape_string($conn, $Mdp);
		// récupérer le statut et supprimer les antislashes ajoutés par le formulaire
		$Statut = stripslashes($_REQUEST['Statut']);
		$Statut = mysqli_real_escape_string($conn, $Statut); 
		// récupérer le code et supprimer les antislashes ajoutés par le formulaire
		$Code = stripslashes($_REQUEST['Code']);
		$Code = mysqli_real_escape_string($conn, $Code);

		// Vérification si le nom d'utilisateur existe déjà
		$query = "SELECT * FROM `connexions` WHERE Nom='$Nom'";
		$result = mysqli_query($conn, $query);
		// Si le nom d'utilisateur existe déjà, afficher un message d'erreur
		if (mysqli_num_rows($result) > 0) {
			echo "<div class='error'>
			<h3>Erreur : Ce nom d'utilisateur existe déjà.</h3>
			</div>";
		}
		else {
			//requéte SQL + mot de passe crypté
			$query = "INSERT INTO `connexions` (Nom, Mdp, Statut, Code) 
			VALUES ('$Nom', '".hash('sha256', $Mdp)."', '$Statut', '$Code')";
			// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res){
				echo "<div class='succes'>
				<h3>Vous êtes inscrit avec succès.</h3>
				<p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
				</div>";
			}
		}
	}
	else {
		?>
		<form class="box" action="" method="post">
			<h1 class="box-logo box-title"><a href="https://smica.fr/" target="_blank"><img src="smica.png" width="330" class="img"></a></h1>
			<h1 class="box-title">Inscription <i class="fa-solid fa-user-plus"></i></h1>
			<input type="text" class="box-input" name="Nom" placeholder="Nom d'utilisateur" required />
			<input type="password" class="box-input" name="Mdp" placeholder="Mot de passe" required />
			<select name="Statut" id="Statut" required>
            <option value="">-- Choisir un statut --</option>
            <option value="Administrateur">Administrateur</option>
            <option value="Responsable">Responsable</option>
            <option value="Utilisateur">Utilisateur</option>
        </select><br>
			<?php
			$Code = rand(100000, 999999);
			?>
			<input type="text" class="box-input" name="Code" value="<?php echo $Code; ?>" readonly />
			<input type="submit" name="submit" value="Envoyer" class="box-button" />
			<p class="box-register">Déjà inscrit ?<a href="login.php">Se connecter</a></p>
		</form>
	<?php } ?>
</body>
</html>

