<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Endpoints</title>
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background-color: #132A2D;
}
.left-content {
  display: flex;
  justify-content: space-between;
  margin: 20px;
  height: 96%;
  background-color: #F6F6FA;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  border-radius: 8px;
  overflow: hidden;
  height: calc(100% - 40px);
}
.column {
  flex: 1;
  padding: 20px;
  height: 100%;
}
.column-1 {
  background-color: #F6F6FA;
}
.column-1 h2 {
  color: #555;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}
.input-section {
  margin-top: auto;
}
.input-section input[type="text"],
.input-section input[type="file"] {
  width: calc(100% - 20px);
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.input-section input[type="file"] {
  border: none;
  background-color: #f0f0f0;
}
#create-button {
  background-color: #4CAF50;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}
#create-button:hover {
  background-color: #45a049;
}
.column-2 {
  background-color: #F6F6FA;
  overflow-y: auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.column-2 h2 {
  color: #555;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
  text-align: center;
}
.column-2 ul {
  list-style-type: none;
  padding: 0;
}
.column-2 li {
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
  display: flex;
  align-items: center;
}
.column-2 li:last-child {
  border-bottom: none;
}
.column-2 img {
  max-width: 100px;
  max-height: 100px;
  margin-right: 10px;
}
@media (max-width: 768px) {
  .left-content {
    flex-direction: column;
  }
  .column {
    padding: 20px;
  }
  #create-button {
    width: 100%;
  }
}
#img-preview {
  max-width: 100%;
  max-height: 200px;
  display: none;
  margin-top: 10px;
}
</style>
</head>
<body>
<div class="left-content">
  <div class="column column-1">
    <h2>Ajouter un endpoint</h2>
    <div class="input-section">
      <form action="create_endpoint.php" method="post" enctype="multipart/form-data">
        <input type="text" name="endpointName" id="endpointName" placeholder="Entrer le nom du endpoint">
        <input type="file" id="img" name="img" accept="image/*" onchange="previewImage()">
        <img id="img-preview" src="#" alt="Aperçu">
        <button type="submit" id="create-button">Créer</button>
      </form>
    </div>
  </div>
  <div class="column column-2">
    <h2>Liste des Endpoint</h2>
    <ul id="endpointList">
      <li><img src="imgs/dolibarr_icon.png" alt="dolibarr"></li>
      <li><img src="imgs/ebay_icon.png" alt="ebay"></li>
      <li><img src="imgs/ebp_icon.png" alt="ebp"></li>
      <li><img src="imgs/hubspot_icon.png" alt="hubspot"></li>
      <li><img src="imgs/sage_icon.png" alt="sage"></li>
      <li><img src="imgs/sellsy.png" alt="sellsy"></li>
      <li><img src="imgs/shopify_icon.png" alt="shopify"></li>
      <li><img src="imgs/wordpress_icon.png" alt="wordpress"></li>
      <li><img src="imgs/kezia_icon.png" alt="kezia"></li>
      <li><img src="imgs/odoo_icon.png" alt="odoo"></li>
      <li><img src="imgs/prestashop_icon.png" alt="prestashop"></li>
    </ul>
  </div>
</div>
<script>
function previewImage() {
  var fileInput = document.getElementById('img');
  var imgPreview = document.getElementById('img-preview');
  if (fileInput.files && fileInput.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      imgPreview.style.display = 'block';
      imgPreview.src = e.target.result;
    };
    reader.readAsDataURL(fileInput.files[0]);
  } else {
    imgPreview.style.display = 'none';
    imgPreview.src = '';
  }
}
</script>
</body>
</html>
