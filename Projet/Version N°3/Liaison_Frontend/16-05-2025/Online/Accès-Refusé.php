<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Refusé</title>
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

        .error-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 500px;
        }

        .error-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .redirect-text {
            font-size: 14px;
            margin-top: 20px;
        }

        .home-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background: #667eea;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .home-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <?php
    // Début du script PHP
    session_start();
    // Détruire la session si l'utilisateur arrive sur cette page
    session_destroy();
    ?>
    <div class="error-container">
        <div class="error-icon">🚫</div>
        <h1>Accès Refusé</h1>
        <p>Vous n'avez pas les droits d'accès nécessaires pour accéder à cette page.</p>
        <p>Cette page est réservée aux administrateurs du système GTB.</p>
        <div class="redirect-text">
            Redirection automatique dans <span id="countdown">5</span> secondes...
        </div>
        <a href="login.php" class="home-link">Retour à la page de connexion</a>
    </div>

    <script>
        // Compte à rebours et redirection
        let timeLeft = 5;
        const countdownElement = document.getElementById('countdown');
        
        const countdown = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = 'index2.php';
            }
        }, 1000);
    </script>
</body>
</html>