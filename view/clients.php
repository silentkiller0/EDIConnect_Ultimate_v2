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
    <script>
        function submitForm(event) {
            event.preventDefault();

            const form = document.getElementById('clientForm');
            const formData = new FormData(form);

            fetch('<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const nom = document.getElementById('nom').value;
                document.getElementById('successMessage').textContent = "Nouveau client " + nom + " ajouté avec succès.";
                const formHeight = form.offsetHeight;
                form.reset();
                form.style.height = formHeight + 'px';
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
<div class="container">
    <div class="left-content">
        <div class="activities">
            <div class="activity-container">
                <h3 class="subtitle">Ajouter un nouveau client :</h3>
                <div class="filtres-group">
                    <form id="clientForm" onsubmit="submitForm(event)">
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
                    <form id="clientForm2" onsubmit="submitForm(event)">
                        <label for="nom2">Nom du client:</label><br>
                        <div class="select-dropdown">
                            <select class="form__select" id="nom2" name="nom2">
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
                        <label for="details2">Détails:</label><br>
                        <textarea id="details2" name="details2" required></textarea>
                        <input type="submit" value="Modifier">
                        <span id="successMessage2"></span>
                        <label id="msg2"></label><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"] ?? $_POST["nom2"];
    $details = $_POST["details"] ?? $_POST["details2"];

    $authDirectory = '../auth/';

    if (!is_dir($authDirectory)) {
        mkdir($authDirectory, 0777, true);
    }

    $fileName = $authDirectory . $nom . '.json';

    $formattedDetails = str_replace('":"', '": "', json_encode($details));

    if (file_put_contents($fileName, $formattedDetails)) {
        echo "<p>Nouveau client ajouté avec succès.</p>";
    } else {
        echo "<p>Une erreur est survenue lors de l'ajout du client.</p>";
    }
}
?>
</body>
</html>
