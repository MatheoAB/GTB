<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nouveau bâtiment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #667eea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 400px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"], input[type="submit"] {
            width: 80%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        select {
            appearance: none;
            background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="gray" d="M7 8l3 3 3-3z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
        }
        select:focus, input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        input[type="submit"] {
            background: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .success, .error {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border-radius: 6px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .box-logo img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .sensor-options {
            margin-top: 15px;
            width: 100%;
        }
        .sensor-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gtb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("<div class='error'>Erreur de connexion : " . $conn->connect_error . "</div>");
        }

        // Récupération des données du formulaire
        $statut = $conn->real_escape_string($_POST['Statut']);
        $nom = $conn->real_escape_string($_POST['Nom']);
        $capteurs = [];

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'sensor-') === 0) {
                $capteurs[] = $conn->real_escape_string($value);
            }
        }

        // Insertion dans la base de données
        $sql = "INSERT INTO batiment (type, nom) VALUES ('$statut', '$nom')";

        if ($conn->query($sql) === TRUE) {
            $batiment_id = $conn->insert_id; // Récupérer l'ID du bâtiment inséré

            // Insérer les capteurs
            foreach ($capteurs as $capteur) {
                $sql_capteur = "INSERT INTO capteurs (batiment_id, type_capteur) VALUES ('$batiment_id', '$capteur')";
                $conn->query($sql_capteur);
            }

            echo "<div class='success'>Le bâtiment et ses capteurs ont été ajoutés avec succès.</div>";
        } else {
            echo "<div class='error'>Erreur : " . $conn->error . "</div>";
        }

        // Fermeture de la connexion
        $conn->close();
    }
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-logo box-title">
            <a href="https://smica.fr/" target="_blank">
                <img src="smica.png" width="300" class="img" alt="SMICA Logo">
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

        <label for="Nom">Nom du bâtiment</label>
        <input type="text" name="Nom" id="Nom" placeholder="Nom du bâtiment" required>

        <label for="list-capteurs">Nombre de capteurs</label>
        <select name="Nombre" id="list-capteurs" required>
            <option value="">Sélectionnez le nombre de capteurs</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

        <div class="sensor-options" id="sensor-options"></div>

        <input type="submit" value="Créer le bâtiment">
    </form>

    <script>
        const sensorsSelect = document.getElementById("list-capteurs");
        const sensorOptionsContainer = document.getElementById("sensor-options");

        sensorsSelect.addEventListener("change", function () {
            const numSensors = parseInt(this.value);
            sensorOptionsContainer.innerHTML = ""; // Clear previous options

            if (numSensors && numSensors > 0) {
                for (let i = 1; i <= numSensors; i++) {
                    const sensorGroup = document.createElement("div");
                    sensorGroup.classList.add("sensor-group");

                    sensorGroup.innerHTML = `
                        <label for="sensor-${i}">Capteur ${i}</label>
                        <select name="sensor-${i}" id="sensor-${i}" required>
                            <option value="">Sélectionnez un type de capteur</option>
                            <option value="temperature">Température</option>
                            <option value="humidity">Humidité</option>
                            <option value="co2">CO2</option>
                        </select>
                    `;

                    sensorOptionsContainer.appendChild(sensorGroup);
                }
            }
        });
    </script>
</body>
</html>