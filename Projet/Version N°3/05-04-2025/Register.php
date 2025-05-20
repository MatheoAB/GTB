<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérification de l'authentification administrateur
if (!isset($_SESSION['user_id']) || 
    !isset($_SESSION['user_role']) || 
    $_SESSION['user_role'] !== 'Administrateur') {
    
    error_log("Tentative d'accès non autorisé à register.php - User ID: " . 
              (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'non défini') . 
              " Role: " . (isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'non défini'));
    
    session_destroy();
    header("Location: access-denied.php");
    exit();
}

// Configuration base de données
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gtb');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("<p class='error-message'>Erreur de connexion : " . $conn->connect_error . "</p>");
}

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['nom']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $telephone = ($role === 'Administrateur') ? trim($_POST['telephone']) : null;

    // Validation du rôle
    $allowed_roles = ['Elu', 'Responsable', 'Administrateur'];
    if (!in_array($role, $allowed_roles)) {
        $errorMessage = "Rôle invalide sélectionné.";
    } elseif ($role === 'Administrateur' && !preg_match("/^[0-9]{10}$/", $telephone)) {
        $errorMessage = "Numéro de téléphone invalide pour l'administrateur.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM clients WHERE email = ? OR nom = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Cet email ou nom d'utilisateur existe déjà.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Modification de la requête pour inclure le téléphone
            $stmt = $conn->prepare("INSERT INTO clients (email, nom, mdp, role, telephone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $email, $username, $hashedPassword, $role, $telephone);
            
            if ($stmt->execute()) {
                $successMessage = "Compte créé avec succès!";
                header("refresh:2;url=choix.php"); // Redirection après 2 secondes
            } else {
                $errorMessage = "Erreur lors de la création du compte.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
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

        .box-input, select.box-input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        select.box-input {
            background-color: white;
            cursor: pointer;
        }

        select.box-input:focus {
            outline: none;
            border-color: #667eea;
        }

        select.box-input option {
            padding: 10px;
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
            margin-top: 20px;
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

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .back-button:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <form class="box" action="" method="post">
        <h1 class="box-logo box-title">
            <a href="https://smica.fr/" target="_blank">
                <img src="smica.png" alt="SMICA Logo">
            </a>
        </h1>
        <h3>Création de compte</h3>
        
        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($successMessage)): ?>
            <p class="success-message"><?php echo htmlspecialchars($successMessage); ?></p>
        <?php endif; ?>

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
        
        <select name="role" class="box-input" id="roleSelect" required>
            <option value="">Sélectionner un rôle</option>
            <option value="Elu" <?php echo (isset($_POST['role']) && $_POST['role'] === 'Elu') ? 'selected' : ''; ?>>Elu</option>
            <option value="Responsable" <?php echo (isset($_POST['role']) && $_POST['role'] === 'Responsable') ? 'selected' : ''; ?>>Responsable</option>
            <option value="Administrateur" <?php echo (isset($_POST['role']) && $_POST['role'] === 'Administrateur') ? 'selected' : ''; ?>>Administrateur</option>
        </select>

        <div id="phoneField" style="display: none;">
            <input type="tel" 
                class="box-input" 
                name="telephone" 
                id="telephone"
                placeholder="Numéro de téléphone" 
                pattern="[0-9]{10}"
                value="<?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : ''; ?>"
                >
            <small style="color: #666;">Format: 0123456789</small>
        </div>
        <input type="submit" class="box-button" value="Créer le compte">
    </form>

    <script>
    function checkAuth() {
        fetch('check_auth.php')
            .then(response => {
                if (!response.ok) {
                    window.location.href = 'access-denied.php';
                }
            })
            .catch(() => {
                window.location.href = 'index.php';
            });
    }
    setInterval(checkAuth, 300000);

    document.getElementById('roleSelect').addEventListener('change', function() {
        const phoneField = document.getElementById('phoneField');
        const phoneInput = document.getElementById('telephone');
        
        if (this.value === 'Administrateur') {
            phoneField.style.display = 'block';
            phoneInput.required = true;
        } else {
            phoneField.style.display = 'none';
            phoneInput.required = false;
            phoneInput.value = '';
        }
    });

    // Vérifier l'état initial au chargement de la page
    window.addEventListener('load', function() {
        const roleSelect = document.getElementById('roleSelect');
        if (roleSelect.value === 'Administrateur') {
            document.getElementById('phoneField').style.display = 'block';
            document.getElementById('telephone').required = true;
        }
    });
</script>
</body>
</html>