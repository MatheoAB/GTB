<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAPI.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Options Administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        .admin-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 500px;
        }

        .admin-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .admin-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background: #667eea;
            border-radius: 5px;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s;
        }

        .admin-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Vérification si l'utilisateur est un administrateur
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrateur') {
        // Redirection si l'utilisateur n'est pas un administrateur
        header('Location: Accès-Refusé.php');
        exit();
    }

    // Récupération du nom de l'utilisateur
    $Nom = isset($_SESSION['Nom']) ? $_SESSION['Nom'] : 'Administrateur';
    ?>
    <div class="admin-container">
        <div class="admin-icon"><i class="fas fa-tools"></i></div>
        <h1>Bienvenue, <?php echo htmlspecialchars($Nom); ?> !</h1>
        <p>Choisissez une action :</p>
        <a href="API-Gestion.php" class="admin-link"><i class="fas fa-plus"></i> Créer un bâtiment</a>
        <a href="Index2.php" class="admin-link"><i class="fas fa-eye"></i> Supervision</a>
        <a href="Register.php" class="admin-link"><i class="fas fa-user-plus"></i> Créer un compte</a>
    </div>
</body>
</html>