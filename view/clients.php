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
            background-color: #132A2D;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Hauteur minimum de 100% de la vue */
        }

        .container {
            max-width: 1420px;
            width: 100%;
            height: 96%;
            margin: 20px auto;
            padding: 20px;
            background-color: #F6F7FB;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; /* Espacement entre les colonnes */
            overflow: hidden; /* Pour éviter le débordement */
        }

        .column {
            width: 48%; /* Réduire légèrement pour laisser un peu d'espace entre les colonnes */
            max-width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            background-color: #FFFFFF; /* Couleur de fond pour les colonnes */
            border-radius: 8px; /* Arrondi pour les coins */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        .add-client-column {
            background-color: #FFFFFF; /* Couleur de fond pour la colonne de gauche */
            margin-right: 20px; /* Espacement entre les colonnes */
        }

        .client-details-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .client-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        h3 {
            color: #41818f; /* Couleur des titres */
        }

        h4 {
            color: #000000; /* Couleur des titres */
        }

        .btn {
            background-color: #6697a1;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #557a88;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #000000;
        }

        input[type="text"], textarea, .form__select {
            width: 100%;
            max-width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
        }

        textarea {
            resize: vertical;
            height: 701px; /* Hauteur fixe pour la zone détails */
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column; /* Empiler les colonnes sur les petits écrans */
            }

            .column {
                width: 100%;
                margin-bottom: 20px; /* Espacement entre les colonnes sur petits écrans */
            }

            .add-client-column {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
      <!-- Colonne Gauche -->
    <div class="column add-client-column">
    <h3>Ajouter un nouveau client :</h3>
    <form id="clientForm" method="POST">
        <label for="nom">Nom du client:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="details">Détails:</label>
        <textarea id="details" name="details"></textarea>
        <input type="submit" value="ADD" class="btn">
        <span id="successMessage"></span>
        <label id="msg"></label>
    </form>
</div>
        <!-- Colonne Droite -->
<div class="column">
    <h3>Modifier :</h3>
    <form id="clientForm2">
        <label for="nom2">Nom du client:</label>
        <div class="select-dropdown">
            <select class="form__select" onchange="chargerDetailsClient()" id="nom2" name="nom2">
                <option selected>Veuillez sélectionner un client</option>
                <!-- Les options seront ajoutées dynamiquement ici -->
            </select>
        </div>
        <button type="button" class="btn" onclick="updateClientList()">Actualiser la liste des clients</button>
    </form>
    <div class="client-details-container">
        <h4>Détails du client:</h4>
        <div class="client-details">
            <textarea id="clientDetails"></textarea>
            <input type="button" value="Modifier" class="btn" onclick="modifierDetailsClient()">
        </div>
    </div>
</div>


    <script>
        function updateClientList() {
            fetch('view/get_clients.php')
                .then(response => response.json())
                .then(data => {
                    let select = document.getElementById('nom2');
                    select.innerHTML = '<option selected>Veuillez sélectionner un client</option>';
                    data.forEach(client => {
                        let option = document.createElement('option');
                        option.value = client;
                        option.textContent = client;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération de la liste des clients:', error));
        }

        function chargerDetailsClient() {
            var selectedClient = document.getElementById('nom2').value;
            var jsonFilePath = "auth/" + selectedClient + ".json";
            fetch(jsonFilePath)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur HTTP, statut ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('clientDetails').value = JSON.stringify(data, null, 4);
                })
                .catch(error => {
                    console.error('Une erreur est survenue lors du chargement des données du client:', error);
                    document.getElementById('clientDetails').innerText = "Une erreur est survenue lors du chargement des données du client.";
                });
        }

        function submitForm(event) {
            event.preventDefault();
            var formData = new FormData(document.getElementById('clientForm'));
            var clientName = document.getElementById('nom').value;
            fetch("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'Success') {
                    document.getElementById('successMessage').innerText = "Erreur lors de l'ajout du client.";
                } else {
                    document.getElementById('successMessage').innerText = "Nouveau Client Ajouté (" + clientName + ") !";
                }
                updateClientList(); // Mise à jour de la liste des clients après l'ajout
            })
            .catch(error => {
                console.error('Une erreur est survenue:', error);
                document.getElementById('successMessage').innerText = "Une erreur est survenue.";
            });
        }

        function modifierDetailsClient() {
            var selectedClient = document.getElementById('nom2').value;
            var newDetails = document.getElementById('clientDetails').value;
            var formData = new FormData();
            formData.append('nom2', selectedClient);
            formData.append('newDetails', newDetails);
            fetch("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'UpdateSuccess') {
                    alert('Erreur lors de la mise à jour des détails du client.');
                } else {
                    alert('Détails du client mis à jour avec succès.');
                    chargerDetailsClient();
                }
            })
            .catch(error => {
                console.error('Une erreur est survenue:', error);
                alert('Détails du client mis à jour avec succès.');
            });
        }

        document.getElementById('clientForm').addEventListener('submit', submitForm);

        // Charger la liste des clients au démarrage
        updateClientList();
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["nom"]) && isset($_POST["details"])) {
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
                echo "Erreur lors de l'ajout du client.";
            } else {
                echo "Nouveau Client Ajouté (" . htmlspecialchars($nom) . ") !";
            }
            
        } elseif (isset($_POST["nom2"]) && isset($_POST["newDetails"])) {
            $nom2 = $_POST["nom2"] ?? "";
            $newDetails = $_POST["newDetails"] ?? "";
            $newDetails = json_decode($newDetails, true);
            $authDirectory = '../auth/';
            $fileName = $authDirectory . $nom2 . '.json';
            $formattedDetails = json_encode($newDetails);
            if (file_put_contents($fileName, $formattedDetails)) {
                echo "Détails du client mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des détails du client.";
            }            
        }
    }
    ?>
</body>
</html>
