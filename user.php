<?php
session_start();
if(!isset($_SESSION['sesusername'])){
  header("Location: ../index.php");
  exit();
}
require 'actions/chartaction.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <h1 style="text-align:center">Welcome to the user page, <?php echo $_SESSION['sesusername'] ?>!</h1>
    <br>
    <link rel="stylesheet" href="css/w3css.css"/>
    <link rel="stylesheet" href="leaflet/leaflet.css"/>
        <style>
              #mapid {height: 50%;
                      width: 50%;
                      margin: "auto"}
                      table, th, td {
                      border: 1px solid black;
                      border-collapse: collapse;
                      padding: 5px;
                      text-align: center;
                      }
        </style>
</head>
<body>
    <div id="mapid"></div>
    <div class="Filters">
      <form  name="Filter">
        <label for="yearFrom">Year from:</label>
        <select name="yearFrom" id="yearFrom">
        </select>

        <label for="yearTo">Year to:</label>
        <select name="yearTo" id="yearTo">
        </select>

        <br>

        <label for="monthFrom">Month from:</label>
        <select name="monthFrom" id="monthFrom">
          <option value=1>January </option>
          <option value=2>February </option>
          <option value=3>March </option>
          <option value=4>April </option>
          <option value=5>May </option>
          <option value=6>June </option>
          <option value=7>July </option>
          <option value=8>August </option>
          <option value=9>September </option>
          <option value=10>October </option>
          <option value=11>November </option>
          <option value=12>December </option>
        </select>

        <label for="monthTo">Month To:</label>
        <select name="monthTo" id="monthTo">
          <option value=1>January </option>
          <option value=2>February </option>
          <option value=3>March </option>
          <option value=4>April </option>
          <option value=5>May </option>
          <option value=6>June </option>
          <option value=7>July </option>
          <option value=8>August </option>
          <option value=9>September </option>
          <option value=10>October </option>
          <option value=11>November </option>
          <option value=12>December </option>
        </select>

        <input type='button' onclick = "ajaxCall()" value='Apply Filters'>
      </form>
    </div>
    <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="jsonfile" id="myFile">
        <button type="submit" name="uploadsubmit">Upload your json file!</button>
    </form>
    <div id="analysisTable" class="tables"></div>
    <script src="javascript/yearDropDown.js"></script>
    <script src="leaflet/leaflet.js"></script>
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="leaflet/map.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <div class="tables">
    <h3>Κορυφαίοι Χρήστες</h3>
    <table style = "width:40%">
      <tr>
        <th>Όνομα</th>
        <th>Score</th>
      </tr>
      <?php require 'actions/leaderaction.php'; ?>
      </table>
    </div>

    <p> Το συνολικό σας score είναι: <?= $wholescore ?> <p>
    <p> Η περίοδος που καλύπτουν οι εγγραφές σας είναι από <?= $mintimestamp ?> μέχρι <?= $maxtimestamp ?>. </p>
    <!-- To parapanw prepei na einai meta to leaderboard gia na exei ginei to require 'actions/leaderboard' kai na blepei tis metavlites-->
    <p> Το τελευταίο σας upload έγινε στις <?= $lastupload ?>.</p>
    <canvas id="chart" width="500" height="150"></canvas>
    <script type="text/javascript">

    new Chart(document.getElementById("chart"), {
      type: 'line',
      data: {
        labels: <?= json_encode($monthlabels); ?>,
        datasets: [{
            data: <?= json_encode($chartdata); ?>,
            borderColor: "#3e95cd",
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Μηνιαίο Score'
        },
        legend: {
          display: false
        }
      }
    });

    </script>

    <form action="actions/logoutaction.php" method="POST">
      <button type="submit" name="logoutsubmit">Logout</button>
    </form>
</body>
</html>
