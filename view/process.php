<!-- ---------------- CLIENT ---------------- -->
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
            <br>
            <label class="switch">Envoie des données à la DMZ
                <input type="checkbox" class="checkbox" id="dmz-checkbox">
                <div class="slider"></div>
            </label>
        </div>
    </div>
</div>
<!-- ---------------- END CLIENT ---------------- -->

<!-- ---------------- ENDPOINTS ---------------- -->
<div class="left-content">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Endpoints :</h3>
            <div class="radio-tile-group" id="endpoint-group">
                <!-- Existing endpoint inputs -->
                <!-- Dolibarr -->
                <div class="input-container">
                    <input id="dolibarr" class="radio-button" type="radio" name="radio-endpoint" value="dolibarr">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/dolibarr_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- eBay -->
                <div class="input-container">
                    <input id="ebay" class="radio-button" type="radio" name="radio-endpoint" value="ebay">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/ebay_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- EBP -->
                <div class="input-container">
                    <input id="ebp" class="radio-button" type="radio" name="radio-endpoint" value="ebp">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/ebp_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- HubSpot -->
                <div class="input-container">
                    <input id="hubspot" class="radio-button" type="radio" name="radio-endpoint" value="hubspot">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/hubspot_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- Sage -->
                <div class="input-container">
                    <input id="sage" class="radio-button" type="radio" name="radio-endpoint" value="sage">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/sage_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- sellsy -->
                <div class="input-container">
                    <input id="sellsy" class="radio-button" type="radio" name="radio-endpoint" value="sellsy">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/sellsy.png" style="width:80px;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bottom row -->
            <div class="radio-tile-group" id="endpoint-group-bottom">
                <!-- shopify -->
                <div class="input-container">
                    <input id="shopify" class="radio-button" type="radio" name="radio-endpoint" value="shopify">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/shopify_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- wordpress -->
                <div class="input-container">
                    <input id="wordpress" class="radio-button" type="radio" name="radio-endpoint" value="wordpress">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/wordpress_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- kezia -->
                <div class="input-container">
                    <input id="kezia" class="radio-button" type="radio" name="radio-endpoint" value="kezia">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/kezia_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- odoo -->
                <div class="input-container">
                    <input id="odoo" class="radio-button" type="radio" name="radio-endpoint" value="odoo">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/odoo_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
                <!-- Prestashop -->
                <div class="input-container">
                    <input id="prestashop" class="radio-button" type="radio" name="radio-endpoint" value="prestashop">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <img src="imgs/prestashop_icon.png" style="width:80px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------- END ENDPOINT ---------------- -->

<!-- ---------------- FLUX ---------------- -->
<div class="left-content">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Flux :</h3>
            <div class="radio-tile-group" id="flux-group">
                <!-- ... (votre liste de flux existante) ... -->
                <!-- Orders (Commandes) -->
                <div class="input-container-flux">
                    <input id="orders" class="radio-button" type="radio" name="radio-flux" value="orders">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Orders </b>
                        </div>
                    </div>
                </div>
                <!-- Products -->
                <div class="input-container-flux">
                    <input id="products" class="radio-button" type="radio" name="radio-flux" value="products">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Products</b>
                        </div>
                    </div>
                </div>
                <!-- Customers (Clients) -->
                <div class="input-container-flux">
                    <input id="customers" class="radio-button" type="radio" name="radio-flux" value="customers">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Customers </b>
                        </div>
                    </div>
                </div>
                <!-- Stock -->
                <div class="input-container-flux">
                    <input id="stock" class="radio-button" type="radio" name="radio-flux" value="stock">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Stock</b>
                        </div>
                    </div>
                </div>
                <!-- Devis -->
                <div class="input-container-flux">
                    <input id="devis" class="radio-button" type="radio" name="radio-flux" value="devis">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b id="test">Devis</b>
                        </div>
                    </div>
                </div>
                <!-- Invoices (Factures) -->
                <div class="input-container-flux">
                    <input id="invoices" class="radio-button" type="radio" name="radio-flux" value="invoices">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Invoices </b>
                        </div>
                    </div>
                </div>
                <!-- Shipments (Livraisons) -->
                <div class="input-container-flux">
                    <input id="shipments" class="radio-button" type="radio" name="radio-flux" value="shipments">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Shipments </b>
                        </div>
                    </div>
                </div>
                <!-- Purchase (Préparation) -->
                <div class="input-container-flux">
                    <input id="purchase" class="radio-button" type="radio" name="radio-flux" value="purchase">
                    <div class="radio-tile">
                        <div class="icon walk-icon">
                            <b>Purchase </b>
                        </div>
                    </div>
                </div>
                <!-- Ajoutez d'autres options de flux si nécessaire -->
            </div>
        </div>
    </div>
</div>

<!-- ---------------- END FLUX ---------------- -->

<!-- ---------------- FILTRE ---------------- -->
<div class="left-content">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Filtre :</h3>
            <div class="filtres-group" id="filtre-group">
                <label class="switch">
                    <input type="checkbox" class="checkbox filtre-ck" name="filtre" data-type="tous" checked>
                    Export tous
                    <div class="slider"></div>
                </label>
                <label class="switch">
                    <input type="checkbox" class="checkbox filtre-ck" name="filtre" data-type="id">
                    Export par ID
                    <div class="slider"></div>
                    <input placeholder="ID" type="text" name="text" class="input">
                </label>
                <label class="switch">
                    <input type="checkbox" class="checkbox filtre-ck" name="filtre" data-type="limite">
                    Export Limité
                    <div class="slider"></div>
                    <input placeholder="max 500" type="number" name="text" max="500" class="input" onchange="limitValue(this)">
                </label>
                <label class="switch">
                    <input type="checkbox" class="checkbox filtre-ck" name="filtre" data-type="date">
                    Export par Date
                    <div class="slider"></div>
                    <input placeholder="Date" type="date" name="text" class="input">
                </label>
                <label class="switch">
                    <input type="checkbox" class="checkbox filtre-ck" name="filtre" data-type="champ">
                    Export par Champ
                    <div class="slider"></div>
                    <input placeholder="Nom du champ" type="text" name="text" class="input">
                </label>
            </div>
        </div>
    </div>
</div>
<!-- ---------------- END FILTRE ---------------- -->

<!-- ---------------- GENERATE BUTTON ---------------- -->
<button class="generate-button" onclick="generateURL()">Generate URL</button>

<!-- ---------------- GENERATED LINK SECTION ---------------- -->
<div class="left-content">
    <div class="activities">
        <div class="activity-container">
            <h3 class="subtitle">Lien généré :</h3>
            <p id="generated-url"></p> <!-- Déplacez cette ligne ici -->
        </div>
    </div>
</div>
<!-- ---------------- END GENERATED LINK SECTION ---------------- -->

<!-- JavaScript -->
<script>
    document.querySelectorAll('.filtre-ck').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.querySelectorAll('.filtre-ck').forEach(otherCheckbox => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
</script>

