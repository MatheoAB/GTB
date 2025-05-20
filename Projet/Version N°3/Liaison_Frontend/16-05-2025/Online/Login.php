<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        .box-logo img {
            max-width: 100%;
            margin-bottom: 15px;
        }

        .box-title {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
        }

        .box-input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .box-button {
            background: #667eea;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 16px;
        }

        .box-button:hover {
            background: #764ba2;
        }

        .box-login {
            margin-top: 15px;
            font-size: 14px;
        }

        .box-login a {
            color: #667eea;
            text-decoration: none;
        }

        .box-login a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Informations d'identification
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root'); // Remplacez par votre utilisateur MySQL
    define('DB_PASSWORD', '');    // Remplacez par votre mot de passe MySQL
    define('DB_NAME', 'gtb');     // Remplacez par le nom de votre base de données

    // Connexion à la base de données MySQL
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("<p class='error-message'>Erreur de connexion à la base de données : " . htmlspecialchars($conn->connect_error) . "</p>");
    }

    $errorMessage = ""; // Variable pour stocker les messages d'erreur

    // Vérifie si le formulaire de connexion est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validation des entrées utilisateur
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $username = htmlspecialchars(trim($_POST['nom']));
        $password = trim($_POST['password']);

        // Préparation de la requête SQL
        $stmt = $conn->prepare("SELECT id, mdp, role, nom FROM clients WHERE email = ? AND nom = ?");
        if ($stmt === false) {
            die("<p class='error-message'>Erreur de préparation : " . htmlspecialchars($conn->error) . "</p>");
        }

        // Liaison des paramètres
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

        // Vérifie le mot de passe sans hachage (DANGEREUX en production)
        if ($password === $user['mdp']) {
            // Authentification réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['Nom'] = $user['nom']; // Utilisé sur la page index2.php


                // Redirection en fonction du rôle
                if ($user['role'] === 'Administrateur') {
                    header("Location: ./Choix.php");
                    exit();
                } else {
                    header("Location: ./index2.php");
                    exit();
                }
            } else {
                $errorMessage = "Mot de passe incorrect.";
            }
        } else {
            $errorMessage = "Email ou nom d'utilisateur incorrect.";
        }

        $stmt->close();
    }

    $conn->close();
?>

<form class="box" action="" method="post">
    <h1 class="box-logo box-title">
        <a href="https://smica.fr/" target="_blank">
            <img src="smica.png" alt="SMICA Logo">
        </a>
    </h1>
    <h3>Connexion</h3>
    <input type="email" 
           class="box-input" 
           name="email" 
           placeholder="Email" 
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
           required>
    <input type="text" 
           class="box-input" 
           name="nom" 
           placeholder="Identifiant" 
           value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>"
           required>
    <input type="password" 
           class="box-input" 
           name="password" 
           placeholder="Mot de passe" 
           required>
    <br>
    <br>
    <input type="submit" class="box-button" value="Se connecter">
    <?php if (!empty($errorMessage)): ?>
        <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>
</form>
</body>
</html>