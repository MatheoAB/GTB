<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styleAPI.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Nouveau bâtiment</title>
</head>
<body>
	<?php
	require('configAPI.php');
	if (isset($_REQUEST['Style'], $_REQUEST['Nom'], $_REQUEST['Nombre'], $_REQUEST['Code'])){
		// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
		$Nom = stripslashes($_REQUEST['Style']);
		$Nom = mysqli_real_escape_string($conn, $Style); 
		// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$Mdp = stripslashes($_REQUEST['Nom']);
		$Mdp = mysqli_real_escape_string($conn, $Nom);
		// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$Mdp = stripslashes($_REQUEST['Nombre']);
		$Mdp = mysqli_real_escape_string($conn, $Nombre);
		// récupérer le code et supprimer les antislashes ajoutés par le formulaire
		$Code = stripslashes($_REQUEST['Code']);
		$Code = mysqli_real_escape_string($conn, $Code);

		// Vérification si le nom d'utilisateur existe déjà
		$query = "SELECT * FROM 'NB' WHERE Nom='$Nom'";
		$result = mysqli_query($conn, $query);
		// Si le nom bâtiment est déjà présent, afficher un message d'erreur
		if (mysqli_num_rows($result) > 0) {
			echo "<div class='error'>
			<h3>Erreur : Ce bâtiment existe déjà.</h3>
			</div>";
		}
		else {
			//requéte SQL + mot de passe crypté
			$query = "INSERT INTO 'NB' (Style, Nom, Nombre, Code) 
			VALUES ('$Style', '$Nom' '".hash('sha256', $Mdp).", '$Code')";
			// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res){
				echo "<div class='succes'>
				<h3>Votre bâtiment à été créé avec succès !</h3>
				<p>Cliquez ici pour y<a href='login.php'>accéder</a></p>
				</div>";
			}
		}
	}
	else {
		?>
		<form class="box" action="" method="post">
			<h1 class="box-logo box-title"><a href="https://smica.fr/" target="_blank"><img src="smica.png" width="330" class="img"></a></h1>
			<h1 class="box-title"><h3>Ajout d'un nouveau bâtiment</h3>
			<select name="Statut" id="Statut" required>
			<option value="">Capteur N°1</option>
            <option value="Administrateur">Administrateur</option>
            <option value="Responsable">Responsable</option>
            <option value="Utilisateur">Utilisateur</option>
			<input type="password" class="box-input" name="Nom" placeholder="Mot de passe" required />
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
			<input type="submit" name="submit" value="Créer mon bâtiment" class="box-button" />
		</form>
	<?php } ?>
</body>
</html>

