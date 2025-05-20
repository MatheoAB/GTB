<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="icone.jpg" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<?php
	require('config.php');
	session_start(); // Démarre la session pour gérer la connexion

	// Vérification si les champs du formulaire sont envoyés
	if (isset($_REQUEST['Nom'], $_REQUEST['Mdp'])) {
		// Récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
		$Nom = stripslashes($_REQUEST['Nom']);
		$Nom = mysqli_real_escape_string($conn, $Nom);

		// Récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$Mdp = stripslashes($_REQUEST['Mdp']);
		$Mdp = mysqli_real_escape_string($conn, $Mdp);

		// Requête SQL pour vérifier si le nom d'utilisateur existe dans la base de données
		$query = "SELECT * FROM `connexions` WHERE Nom='$Nom'";
		$result = mysqli_query($conn, $query);

		// Vérification si le nom d'utilisateur existe dans la base de données
		if (mysqli_num_rows($result) > 0) {
			// Récupérer les informations de l'utilisateur
			$row = mysqli_fetch_assoc($result);
			// Vérifier si le mot de passe correspond à celui de la base de données
			if (hash('sha256', $Mdp) === $row['Mdp']) {
				// Si le mot de passe est correct, démarrez la session et redirigez vers index.php
				$_SESSION['Nom'] = $Nom;  // Stocker le nom d'utilisateur dans la session
				$_SESSION['user_id'] = $row['id']; // Optionnel : si vous avez un id d'utilisateur

				// Rediriger vers la page index.php après la connexion réussie
				header('Location: Acceuil.php');
				exit();  // Assurez-vous d'arrêter l'exécution du script après la redirection
			} else {
				// Si le mot de passe ne correspond pas
				echo "<div class='error'>
				<h3>Erreur : Mot de passe incorrect.</h3>
				</div>";
			}
		} else {
			// Si le nom d'utilisateur n'existe pas
			echo "<div class='error'>
			<h3>Erreur : Nom d'utilisateur non trouvé.</h3>
			</div>";
		}
	}
	?>

	<form class="box" action="" method="post">
		<h1 class="box-logo box-title"><a href="https://smica.fr/" target="_blank"><img src="smica.png" width="330" class="img"></a></h1>
		<h1 class="box-title">Connexion <i class="fa-solid fa-user-lock"></i></h1>
		<input type="text" class="box-input" name="Nom" placeholder="Nom d'utilisateur" required />
		<input type="password" class="box-input" name="Mdp" placeholder="Mot de passe" required />
		<input type="submit" name="submit" value="Se connecter" class="box-button" />
		<p class="box-register">Pas encore de compte ? <a href="register.php">Inscrivez-vous</a></p>
	</form>
	</body>
</html>

