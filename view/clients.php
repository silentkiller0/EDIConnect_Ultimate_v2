<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .left-content, .right-content {
            flex: 1 1 48%;
            padding: 20px;
            box-sizing: border-box;
            min-width: 300px;
        }

        .activity-container {
            margin-bottom: 20px;
        }

        .subtitle {
            color: #6697a1;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .filtres-group {
            margin-bottom: 20px;
        }

        .select-dropdown select, .form__select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        textarea {
            resize: none;
            overflow: auto;
            height: 200px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #6697a1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #successMessage {
            display: block;
            margin-top: 10px;
            color: green;
        }

        .client-details {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .left-content, .right-content {
                flex: 1 1 100%;
                margin-bottom: 20px;
            }

            .subtitle {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-content">
        <div class="activities">
            <div class="activity-container">
                <h3 class="subtitle">Ajouter un nouveau client :</h3>
                <div class="filtres-group">
                    <form id="clientForm" method="POST">
                        <label for="nom">Nom du client:</label><br>
                        <input type="text" id="nom" name="nom" required><br>
                        <label for="details">Détails:</label><br>
                        <textarea id="details" name="details" required></textarea>
                        <input type="submit" value="ADD">
                        <span id="successMessage"></span>
                        <label id="msg"></label><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="right-content">
        <div class="activities">
            <div class="activity-container">
                <h3 class="subtitle">Modifier :</h3>
                <div class="filtres-group">
                    <form id="clientForm2">
                        <label for="nom2">Nom du client:</label><br>
                        <div class="select-dropdown">
                            <select class="form__select" onchange="chargerDetailsClient()" id="nom2" name="nom2">
                                <option selected>Veuillez sélectionner un client</option>
                                <?php
                                $repertoire = "../auth/";

                                if (is_dir($repertoire)) {
                                    $fichiers = scandir($repertoire);

                                    foreach ($fichiers as $fichier) {
                                        if ($fichier != "." && $fichier != "..") {
                                            $nomFichierSansExtension = pathinfo($fichier, PATHINFO_FILENAME);
                                            echo '<option value="' . $nomFichierSansExtension . '">' . ucfirst($nomFichierSansExtension) . '</option>';
                                        }
                                    }
                                } else {
                                    echo "Le répertoire spécifié n'existe pas.";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <!-- Ajout de la section pour afficher les détails du client -->
                <div class="client-details">
                    <h4>Détails du client:</h4>
                    <p id="clientDetails"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function chargerDetailsClient() {
        var selectedClient = document.getElementById('nom2').value;
        var jsonFilePath = "auth/" + selectedClient + ".json";
        fetch(jsonFilePath)
            .then(response => response.json())
            .then(data => {
                document.getElementById('clientDetails').innerText = JSON.stringify(data);
            })
            .catch(error => {
                console.error('Une erreur est survenue lors du chargement des données du client:', error);
                document.getElementById('clientDetails').innerText = "Une erreur est survenue lors du chargement des données du client.";
            });
    }

    function submitForm(event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById('clientForm'));
    var clientName = document.getElementById('nom').value; // Déclaration de la variable clientName
    fetch("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'Success') { // Vérification si la réponse du serveur est 'Success'
            document.getElementById('successMessage').innerText = "Erreur lors de l'ajout du client.";
        } else {
            document.getElementById('successMessage').innerText = "Nouveau Client Ajouté (" + clientName + ") !";

        }
    })
    .catch(error => {
        console.error('Une erreur est survenue:', error);
        document.getElementById('successMessage').innerText = "Une erreur est survenue.";
    });
}


    document.getElementById('clientForm').addEventListener('submit', submitForm);
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"] ?? "";
    $details = $_POST["details"] ?? "";
    $details = str_replace(array("\r", "\n"), ' ', $details);
    $authDirectory = '../auth/';
    if (!is_dir($authDirectory)) {
        mkdir($authDirectory, 0777, true);
    }
    $fileName = $authDirectory . $nom . '.json';
    $formattedDetails = json_encode($details);
    if (file_put_contents($fileName, $formattedDetails)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>

</body>
</html>
