<?php
$repertoire = "/Applications/XAMPP/xamppfiles/htdocs/GUI1/auth/";

$clients = [];

if (is_dir($repertoire)) {
    $fichiers = scandir($repertoire);
    foreach ($fichiers as $fichier) {
        if ($fichier != "." && $fichier != "..") {
            $nomFichierSansExtension = pathinfo($fichier, PATHINFO_FILENAME);
            $clients[] = ucfirst($nomFichierSansExtension);
        }
    }
}

header('Content-Type: application/json');
echo json_encode($clients);
?>
