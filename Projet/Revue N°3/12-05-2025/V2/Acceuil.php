<?php session_start();
	if (!isset($_SESSION['Nom'])) 
		{
		header("Location: login.php");
		exit(); } $nomUtilisateur = $_SESSION['Nom'];
?> 
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Accueil</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<header>
			<h1>Bienvenue,<?php echo htmlspecialchars($nomUtilisateur); ?> !</h1>
			<nav>
				<ul>
					<li>
						<a href="index.php">Accueil</a>
					</li>
					<li>
						<a href="profile.php">Mon Profil</a>
					</li>
					<li>
						<a href="contact.php">Contact</a>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<p>Bienvenue sur votre espace personnel.</p>
		</main>
	</body>
</html>