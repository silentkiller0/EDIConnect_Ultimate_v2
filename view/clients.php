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
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .left-content, .right-content {
            width: 48%;
            height: 950px;
            background-color: #F6F7FB;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .activity-container {
            margin-bottom: 20px;
        }

        .subtitle {
            color: #6697a1;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        #successMessage {
            display: block;
            margin-top: 10px;
            color: green;
            text-align: center;
        }

        .select-dropdown,
        .form__select {
            width: 100%;
            max-width: 600px;
            margin: 10px 0;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
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
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .client-details {
            margin-top: 20px;
        }

        textarea {
            resize: none;
        }

        h4 {
            margin-left: 28px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="left-content" style="width: 48%;height: 950px;">
        <div class="activities">
            <div class="activity-container">
                <h3 class="subtitle"style="margin-left: 35px;">Ajouter un nouveau client :</h3>
                <div class="filtres-group">
                    <form id="clientForm" method="POST">
                    <label for="nom">Nom du client:</label><br>
                        <input type="text" id="nom" name="nom" style="width: 100%;" required><br>
                        <label for="details">Détails:</label><br>
                        <textarea id="details" name="details" style="width: 600px; height: 650px;"></textarea>
                        <input type="submit" value="ADD" class="btn">
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
                        <label for="nom2">Nom du client:</label>
                        <div class="select-dropdown">
                            <select class="form__select" onchange="chargerDetailsClient()" id="nom2" name="nom2">
                                <option selected>Veuillez sélectionner un client</option>
                                <!-- Les options seront ajoutées dynamiquement ici -->
                            </select>
                        </div>
                        <button type="button" class="btn" onclick="updateClientList()">Actualiser la liste des clients</button>
                    </form>
                </div>
                <div class="client-details">
                <h4 style="margin-left: -1px;">Détails du client:</h4>
                <br>
                    <textarea id="clientDetails" style="width: 650x; height: 570px;"></textarea>
                    <input type="button" value="Modifier" class="btn" onclick="modifierDetailsClient()">
                </div>
            </div>
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
            echo "Success";
        } else {
            echo "Error";
        }
    } elseif (isset($_POST["nom2"]) && isset($_POST["newDetails"])) {
        $nom2 = $_POST["nom2"] ?? "";
        $newDetails = $_POST["newDetails"] ?? "";
        $newDetails = json_decode($newDetails, true);
        $authDirectory = '../auth/';
        $fileName = $authDirectory . $nom2 . '.json';
        $formattedDetails = json_encode($newDetails);
        if (file_put_contents($fileName, $formattedDetails)) {
            echo "UpdateSuccess";
        } else {
            echo "UpdateError";
        }
    }
}
?>
</body>
</html>
