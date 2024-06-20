<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #6697a1;
        }
        .left-content {
            width: calc(100% - 40px); /* Largeur totale moins les marges */
            height: calc(100% - 40px); /* Hauteur totale moins les marges */
            margin: 20px; /* Marge de 20px tout autour */
            display: flex; /* Utilisation d'une disposition flex */
            flex-direction: column; /* Alignement vertical des éléments */
            align-items: center; /* Centrage horizontal des éléments */
        }
        .log-container {
            width: 100%;
            height: 100%;
            padding: 0 20px; /* Ajout de padding de 20px sur les côtés */
            box-sizing: border-box; /* Inclut le padding dans la largeur totale */
        }
        .log-textarea {
            width: 100%; /* Utilise la largeur complète du conteneur parent */
            height: 100%; /* Utilise la hauteur complète du conteneur parent */
            margin-top: 0px; /* Marge supérieure pour séparer du contenu précédent */
            padding: 5px; /* Ajout de rembourrage pour plus d'espace à l'intérieur */
            box-sizing: border-box; /* Inclut la bordure et le rembourrage dans la largeur/hauteur */
            resize: vertical; /* Permet le redimensionnement vertical */
            overflow-y: auto; /* Active le défilement vertical lorsque nécessaire */
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 8px; /* Coins arrondis */
            font-family: Arial, sans-serif; /* Police de caractères */
            font-size: 14px; /* Taille de police */
            line-height: 1.6; /* Hauteur de ligne */
        }
    </style>
</head>
<body>
    <div class="left-content">
        <h1>Logs</h1>
        <div class="log-container">
            <textarea class="log-textarea" id="logTextArea" readonly></textarea>        
        </div>
    </div>

    <script>
        function fetchLogs() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_logs.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('logTextArea').innerText = xhr.responseText;
                }
            };
            xhr.send();
        }

        setInterval(fetchLogs, 1000); // Fetch logs every 1 second
        window.onload = fetchLogs; // Fetch logs when the page loads
    </script>
</body>
</html>
