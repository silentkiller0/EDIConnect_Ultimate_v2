<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Client</title>
    <style>
        .left-content {
            float: left;
            width: 50%;
            padding: 20px;
        }

        .activity-container {
            margin-bottom: 20px;
        }

        .subtitle {
            color: #6697a1;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .filtres-group {
            margin-bottom: 20px;
        }

        .select-dropdown select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form__select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <script>
    function submitForm(event) {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire

        const form = document.getElementById('clientForm');
        const formData = new FormData(form);

        fetch('<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Afficher le message de succès avec le nom du client
            const nom = document.getElementById('nom').value;
            document.getElementById('successMessage').textContent = "Nouveau client " + nom + " ajouté avec succès.";
            // Conserver la hauteur du formulaire
            const formHeight = form.offsetHeight;
            // Réinitialiser le formulaire après l'envoi
            form.reset();
            // Réappliquer la hauteur du formulaire
            form.style.height = formHeight + 'px';
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</head>
<body>
<div class="left-content" style="height: 97%; display: flex; align-items: flex-start;">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Ajouter un nouveau client :</h3>
            <div class="filtres-group">
                <form id="clientForm" onsubmit="submitForm(event)">
                    <label for="nom" style="width: 100%;">Nom du client:</label><br>
                    <input type="text" id="nom" name="nom" style="width: 305%;" required><br>
                    <label for="details" style="width: 100%;">Détails:</label><br>
                    <textarea id="details" name="details" style="width: 305%; height: 790px; resize: none; overflow: auto;" required></textarea>
                    <input type="submit" value="ADD">
                    <span id="successMessage"></span>
                    <label id="msg"></label><br>
                </form>
            </div>
        </div>
    </div>
</div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST["nom"];
            $details = $_POST["details"];

            $authDirectory = '../auth/';

            if (!is_dir($authDirectory)) {
                mkdir($authDirectory, 0777, true);
            }

            $fileName = $authDirectory . $nom . '.json';

            // Formater les détails pour l'affichage dans le fichier JSON
            $formattedDetails = str_replace('":"', '": "', json_encode($details));

            if (file_put_contents($fileName, $formattedDetails)) {
                echo "<p>Nouveau client ajouté avec succès.</p>";
            } else {
                echo "<p>Une erreur est survenue lors de l'ajout du client.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
