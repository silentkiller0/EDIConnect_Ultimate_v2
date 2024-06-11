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
            justify-content: space-between;
            padding: 20px;
        }
        
        .activity-container {
            margin-bottom: 20px;
        }

        .subtitle {
            color: #6697a1;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        #successMessage {
            display: block;
            margin-top: 10px;
            color: green;
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
                        <textarea id="details" name="details" style="width: 663px; height: 786px;"></textarea>
                        <input type="submit" value="ADD" class="btn">
                        <span id="successMessage"></span>
                        <label id="msg"></label><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="right-content" style="width: 50%;height: 950px;">
        <div class="activities">
            <div class="activity-container">
                <h3 class="subtitle"style="margin-left: 28px;"> Modifier :</h3>
                <div class="filtres-group">
                    <form id="clientForm2">
                        <label for="nom2">Nom du client:</label><br>
                        <div class="select-dropdown" style="width: 100%; text-align: left;">
                        <select class="form__select" onchange="chargerDetailsClient()" id="nom2" name="nom2">
                                <option selected>Veuillez sélectionner un client</option>
                                <!-- Les options seront ajoutées dynamiquement ici -->
                            </select>
                        </div>
                        <button type="button" class="btn" onclick="updateClientList()">Actualiser la liste des clients</button>
                    </form>
                </div>
                <div class="client-details">
                <h4 style="margin-left: 28px;">Détails du client:</h4>
                    <textarea id="clientDetails" style="width: 731px; height: 693px; margin-left: 30px;" required=""></textarea>
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
                // Mettre à jour le contenu de la zone de texte
                document.getElementById('clientDetails').innerText = JSON.stringify(data);
                document.getElementById('clientDetails').value = JSON.stringify(data, null, 4); // Affichage formaté
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
                updateClientList(); // Mise à jour de la liste des clients après l'ajout
            } else {
                document.getElementById('successMessage').innerText = "Nouveau Client Ajouté (" + clientName + ") !";
            }
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
        fetch("<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
{
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(data => {
    if (data.trim() === 'UpdateSuccess') {
        alert('Détails du client mis à jour avec succès.');
        chargerDetailsClient();
    } else {
        alert('Détails du client mis à jour avec succès.');

    }
})
.catch(error => {
    console.error('Détails du client mis à jour avec succès.', error);
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
