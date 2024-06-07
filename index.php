<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>EDIConnect - Ultimate</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
  <link rel="stylesheet" href="./style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .generate-button {
      display: block;
      width: 100%;
      padding: 15px;
      font-size: 18px;
      margin: 20px 0;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      border: none;
      cursor: pointer;
    }

    .generate-button:hover {
      background-color: #45a049;
    }

    #generated-url {
      margin-top: 10px;
      font-size: 16px;
      word-break: break-all;
    }
  </style>
</head>

<body>
  <main>
    <nav class="main-menu">
      <center><img class="logo" src="imgs/logo.png" alt="" /></center>
      <ul>
        <li class="nav-item active">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentProcess(event)">
            <i class="fa-solid fa-microchip nav-icon"></i>
            <span class="nav-text">Process</span>
          </a>
        </li>
        <li class="nav-item">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentClients(event)">
            <i class="fa fa-users nav-icon"></i>
            <span class="nav-text">Clients</span>
          </a>
        </li>
        <li class="nav-item">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentEndpoints(event)">
            <i class="fa-solid fa-server nav-icon"></i>
            <span class="nav-text">Endpoints</span>
          </a>
        </li>
        <li class="nav-item">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentFlux(event)">
            <i class="fa-solid fa-database nav-icon"></i>
            <span class="nav-text">Flux</span>
          </a>
        </li>
        <li class="nav-item">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentCronjob(event)">
            <i class="fa-solid fa-clock nav-icon"></i>
            <span class="nav-text">Cronjob</span>
          </a>
        </li>
        <li class="nav-item">
          <b></b>
          <b></b>
          <a href="" onclick="LoadContentLogs(event)">
            <i class="fa-solid fa-file-lines nav-icon"></i>
            <span class="nav-text">Logs</span>
          </a>
        </li>
      </ul>
    </nav>

    <section class="content" id="content" style="height:1000px">
      
    </section>
  </main>

  <script src="./script.js"></script>
  <script>
    $(document).ready(function() {
      // Charger automatiquement process.php lors du chargement de la page
      $("#content").load("./view/process.php");
    });
    function generateURL() {
      const client = document.getElementById('form__select').value;
      const dmz = document.getElementById('dmz-checkbox').checked ? 'yes' : 'no';

      let endpoint;
      document.querySelectorAll('input[name="radio-endpoint"]').forEach((elem) => {
        if (elem.checked) {
          endpoint = elem.value;
        }
      });

      let flux;
      document.querySelectorAll('input[name="radio-flux"]').forEach((elem) => {
        if (elem.checked) {
          flux = elem.value;
        }
      });

      let typeexport = [];
      let valueexport = [];

      // Vérifier si "Export tous" est sélectionné
      const exportTousCheckbox = document.querySelector('input[data-type="tous"]');
      if (exportTousCheckbox.checked) {
        typeexport.push('all');
        valueexport.push('all');
      } else {
        document.querySelectorAll('.filtre-ck').forEach((elem) => {
          if (elem.checked) {
            const input = elem.nextElementSibling.nextElementSibling;
            const dataType = elem.getAttribute('data-type');
            let inputValue = input ? input.value : '';

            // Vérifier si la saisie est numérique pour les filtres ID et Limite
            if (dataType === 'id' || dataType === 'limite') {
              inputValue = parseInt(inputValue); // Convertir en entier
              if (isNaN(inputValue)) {
                alert('Veuillez saisir une valeur numérique');
                return; // Arrêter la fonction si la saisie n'est pas numérique
              }
            }

            // Limiter la valeur de Limite à 500
            if (dataType === 'limite' && inputValue > 500) {
              inputValue = 500;
            }

            typeexport.push(dataType);
            valueexport.push(inputValue);
          }
        });
      }

      const url = `https://example.com/process?client=${client}&dmz=${dmz}&endpoint=${endpoint}&flux=${flux}&typeexport=${typeexport.join(',')}&valueexport=${valueexport.join(',')}`;

      const urlEnMinuscules = url.toLowerCase();

      document.getElementById('generated-url').innerText = urlEnMinuscules;
    }
    function limitValue(input) {
      if (input.value > 500) {
        input.value = 500;
      }
    }
    function LoadContentProcess(event) {
      event.preventDefault();
      $("#content").load("./view/process.php");
    }
    function LoadContentLogs(event) {
      event.preventDefault();
      $("#content").load("./view/logs.php");
    }
    function LoadContentClients(event) {
      event.preventDefault();
      $("#content").load("./view/clients.php");
    }
    function LoadContentEndpoints(event) {
      event.preventDefault();
      $("#content").load("./view/endpoints.php");
    }
    function LoadContentFlux(event) {
      event.preventDefault();
      $("#content").load("./view/flux.php");
    }
    function LoadContentCronjob(event) {
      event.preventDefault();
      $("#content").load("./view/cronjob.php");
    }

  </script>
</body>

</html>
