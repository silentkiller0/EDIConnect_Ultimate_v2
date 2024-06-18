<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom du endpoint depuis le formulaire
    $endpointName = $_POST["endpointName"];

    if (!empty($endpointName)) {
        // Chemin complet du dossier à créer
        $directoryPath = "/Applications/XAMPP/xamppfiles/htdocs/GUI1/endpoints/" . $endpointName;

        // Vérifier si le dossier n'existe pas déjà
        if (!file_exists($directoryPath)) {
            // Créer le dossier avec les permissions nécessaires (par exemple, 0755 pour les permissions de dossier standard)
            if (mkdir($directoryPath, 0755, true)) {
                echo "Dossier du endpoint créé : " . $directoryPath;
            } else {
                echo "Erreur lors de la création du dossier.";
            }
        } else {
            echo "Le dossier existe déjà.";
        }
    } else {
        echo "Veuillez entrer un nom pour le endpoint.";
    }
}
?>
