<?php
$logFile = '/Applications/XAMPP/xamppfiles/htdocs/GUI1/logs/test.log'; // Chemin vers votre fichier de logs
if (file_exists($logFile)) {
    echo file_get_contents($logFile);
} else {
    echo "Le fichier de logs n'existe pas.";
}
?>
