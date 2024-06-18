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

/* Wrapper for the columns */
.left-content {
  display: flex;
  justify-content: space-between;
  max-width: 1000px;
  margin: 20px auto;
  background-color: #F6F6FA;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  border-radius: 8px;
  overflow: hidden;
}

/* Each column */
.column {
  flex: 1; /* Equal width for both columns */
  padding: 20px;
  height: 100%;
}

/* Styling for Column 1 */
.column-1 {
  background-color: #F6F6FA;
}

.column-1 h2 {
  color: #555;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}

.input-section {
  margin-top: auto; /* Pushes it to the bottom */
}

.input-section input[type="text"],
.input-section input[type="file"] {
  width: calc(100% - 20px); /* Adjust for padding */
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
  background-color: #4CAF50; /* Green */
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

/* Styling for Column 2 */
.column-2 {
  background-color: #F6F6FA;
  overflow-y: auto; /* Enable scrolling if content overflows */
}

.column-2 h2 {
  color: #555;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}

.column-2 ul {
  list-style-type: none;
  padding: 0;
}

.column-2 li {
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
}

.column-2 li:last-child {
  border-bottom: none;
}

@media (max-width: 768px) {
  .left-content {
    flex-direction: column; /* Stack columns vertically on smaller screens */
  }

  .column {
    padding: 20px;
  }

  #create-button {
    width: 100%;
  }
}

/* Additional styles for image preview */
#img-preview {
  max-width: 100%;
  max-height: 200px; /* Limit height to 200px */
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
      <form action="create_endpoint.php" method="post">
        <input type="text" name="endpointName" id="endpointName" placeholder="Entrer le nom du endpoint">
        <input type="file" id="img" name="img" accept="image/*" onchange="previewImage()">
        <img id="img-preview" src="#" alt="Aperçu">
        <button type="submit" id="create-button">Créer</button>
      </form>
    </div>
  </div>
  <div class="column column-2">
    <h2>Liste des Services</h2>
    <ul id="endpointList">
      <li>dolibarr</li>
      <li>ebay</li>
      <li>ebp</li>
      <li>hubspot</li>
      <li>sage</li>
      <li>sellsy</li>
      <li>shopify</li>
      <li>wordpress</li>
      <li>kezia</li>
      <li>odoo</li>
      <li>prestashop</li>
    </ul>
  </div>
</div>

<script>
function previewImage() {
  var fileInput = document.getElementById('img');
  var imgPreview = document.getElementById('img-preview');

  // Ensure a file is selected
  if (fileInput.files && fileInput.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      imgPreview.style.display = 'block';
      imgPreview.src = e.target.result;
    };

    reader.readAsDataURL(fileInput.files[0]); // Read the image file as a data URL
  }
}
</script>

</body>
</html>
