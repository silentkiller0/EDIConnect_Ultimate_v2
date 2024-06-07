<div class="left-content">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Clients :</h3>
            <div class="filtres-group">
                <div class="select-dropdown">
                    <select class="form__select" id="form__select">
                        <option selected>Veuillez selectionner un client</option>
                        <?php
                        $repertoire = "../auth/";

                        if (is_dir($repertoire)) {
                            $fichiers = scandir($repertoire);
                            
                            foreach ($fichiers as $fichier) {
                                // Exclure les entrées "." et ".."
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
            </div>