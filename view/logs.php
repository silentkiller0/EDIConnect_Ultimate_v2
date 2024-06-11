


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
            width: 98%;
            height: 970px;
            display: flex; /* Utilisation d'une disposition flex */
            flex-direction: column; /* Alignement vertical des éléments */
            align-items: center; /* Centrage horizontal des éléments */
        }
        .log-container {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
        }
       .log-textarea {
            width: 98%; /* Utilise la largeur complète du conteneur parent */
            height: 900px; /* Hauteur de la zone de texte */
            margin-top: 0px; /* Marge supérieure pour séparer du contenu précédent */
            padding: 10px; /* Ajout de rembourrage pour plus d'espace à l'intérieur */
            box-sizing: border-box; /* Inclut la bordure et le rembourrage dans la largeur/hauteur */
            resize: vertical; /

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

