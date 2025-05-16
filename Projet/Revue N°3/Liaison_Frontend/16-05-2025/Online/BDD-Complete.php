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
    
    // Function to sanitize input
    function sanitizeInput($conn, $input) {
        return mysqli_real_escape_string($conn, $input);
    }

    // Function to create necessary tables
    function createTables($dbco) {
        $tables = [
            "CREATE TABLE IF NOT EXISTS connexions (
                ID int(11) NOT NULL AUTO_INCREMENT,
                Nom varchar(30) NOT NULL,
                Mdp varchar(100) NOT NULL,
                Statut varchar(20) NOT NULL,
                Code varchar(20) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
            "CREATE TABLE IF NOT EXISTS etats (
                ID int(11) NOT NULL AUTO_INCREMENT,
                Passerelle tinyint(1) NOT NULL,
                Connecteur tinyint(1) NOT NULL,
                CapteurT tinyint(1) NOT NULL,
                CapteurM tinyint(1) NOT NULL,
                CapteurC tinyint(1) NOT NULL,
                CapteurB tinyint(1) NOT NULL,
                AlarmeT tinyint(1) NOT NULL,
                AlarmeA tinyint(1) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
            "CREATE TABLE IF NOT EXISTS logs (
                ID int(11) NOT NULL AUTO_INCREMENT,
                Connexions varchar(20) NOT NULL,
                Modifications varchar(100) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
            "CREATE TABLE IF NOT EXISTS variables (
                ID int(11) NOT NULL AUTO_INCREMENT,
                Temp float NOT NULL,
                ConsT float NOT NULL,
                Luminosite float NOT NULL,
                ConsL float NOT NULL,
                Mouvement tinyint(1) NOT NULL,
                Eau float NOT NULL,
                Electricite float NOT NULL,
                Gaz float NOT NULL,
                Air varchar(25) NOT NULL,
                Date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"
        ];

        foreach ($tables as $sql) {
            $dbco->exec($sql);
        }
    }

    // Connect to the database and create tables
    try {
        $servername = 'localhost';
        $dbname = 'ecole';
        $user = 'root';
        $pass = '';

        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        createTables($dbco);
        echo 'Tables créées avec succès !<br>';

        // Insertion des données d'exemple
        $sql = "INSERT INTO connexions (Nom, Mdp, Statut, Code, Date) VALUES 
        ('Test', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Admin', '235649', '2025-03-10 13:29:44')";
        $dbco->exec($sql);
        echo 'Données insérées avec succès !<br>';
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Check if form is submitted
    if (isset($_POST['Statut'], $_POST['Nom'], $_POST['Nombre'], $_POST['Code'])) {
        // Sanitize inputs
        $Style = sanitizeInput($conn, $_POST['Statut']);
        $Nom = sanitizeInput($conn, $_POST['Nom']);
        $Nombre = sanitizeInput($conn, $_POST['Nombre']);
        $Code = sanitizeInput($conn, $_POST['Code']);

        // Validate Nombre
        if (!is_numeric($Nombre) || intval($Nombre) < 1 || intval($Nombre) > 6) {
            echo "<div class='error'><h3>Erreur : Le nombre de capteurs est invalide.</h3></div>";
        } else {
            // Verify building name doesn't already exist
            $query = "SELECT * FROM `NB` WHERE Nom = '$Nom'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='error'><h3>Erreur : Ce bâtiment existe déjà.</h3></div>";
            } else {
                // Insert new building record
                $hashedCode = hash('sha256', $Code);
                $insertQuery = "INSERT INTO `NB` (Style, Nom, Nombre, Code) VALUES ('$Style', '$Nom', '$Nombre', '$hashedCode')";
                $res = mysqli_query($conn, $insertQuery);

                if ($res) {
                    echo "<div class='success'><h3>Votre bâtiment a été créé avec succès !</h3><p>Cliquez ici pour <a href='login.php'>accéder</a></p></div>";
                } else {
                    echo "<div class='error'><h3>Erreur lors de la création du bâtiment.</h3></div>";
                }
            }
        }
    } else {
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-logo box-title">
            <a href="https://smica.fr/" target="_blank">
                <img src="smica.png" width="330" class="img" alt="SMICA Logo">
            </a>
        </h1>
        <h3>Ajout d'un nouveau bâtiment</h3>

        <label for="Statut">Type de bâtiment</label>
        <select name="Statut" id="Statut" required>
            <option value="">Sélectionnez un type de bâtiment</option>
            <option value="Ecole">Ecole</option>
            <option value="Gymnase">Gymnase</option>
            <option value="Mairie">Mairie</option>
        </select>

        <label for="list-capteurs">Nombre de capteurs</label>
        <select name="Nombre" id="list-capteurs" required>
            <option value="">Sélectionnez le nombre de capteurs</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <div id="additional-sensor-options" style="display:none;">
            <h4>Choix des capteurs supplémentaires</h4>
            <div id="sensor-choices"></div>
        </div>

        <script>
            document.getElementById('list-capteurs').addEventListener('change', function() {
                const additionalOptionsDiv = document.getElementById('additional-sensor-options');
                const sensorChoicesDiv = document.getElementById('sensor-choices');
                const selectedSensors = parseInt(this.value);
                sensorChoicesDiv.innerHTML = '';

                if (selectedSensors > 1) {
                    additionalOptionsDiv.style.display = 'block';
                    for (let i = 2; i <= selectedSensors; i++) {
                        const sensorChoiceSection = document.createElement('div');
                        sensorChoiceSection.innerHTML = `
                            <label for="sensor-choice-${i}">Choix du capteur ${i}</label>
                            <select name="sensor-choice-${i}" id="sensor-choice-${i}" required>
                                <option value="">Sélectionnez un type de capteur</option>
                                <option value="temperature">Température</option>
                                <option value="humidity">Humidité</option>
                                <option value="co2">CO2</option>
                                <option value="air-quality">Qualité de l'air</option>
                            </select>
                        `;
                        sensorChoicesDiv.appendChild(sensorChoiceSection);
                    }
                } else {
                    additionalOptionsDiv.style.display = 'none';
                }
            });
        </script>

        <input type="text" name="Nom" placeholder="Nom du bâtiment" required>
        <input type="text" name="Code" placeholder="Code du bâtiment" required>
        <input type="submit" value="Créer le bâtiment">
    </form>
    <?php } ?>
</body>
</html>