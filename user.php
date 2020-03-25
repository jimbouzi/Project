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
    <link rel="stylesheet" href="css/w3css.css"/>
    <link rel="stylesheet" href="leaflet/leaflet.css"/>
        <style>
              #mapid {height: 50%;
                      width: 50%;
                      margin: "auto"}
        </style>
</head>
<body>
    <div id="mapid"></div>
	        <!--<p class="fallback">Upload your JSON file: <input name="file" type="file" id="file"></input></p> -->

      <form  name="Filter" method="POST">
      From:
      <input type="date" name="dateFrom"/>
      <br/>
      To:
      <input type="date" name="dateTo"/>
      <input type="submit" name="submit" value="Dates"/>


  	<?php
  	/*$new_date = strtotime($_POST['dateFrom']);
  	echo $new_date;

  	echo "<br>";
  	$new_date2 = strtotime($_POST['dateTo']);
  	echo $new_date2;
    */
  	?>
  </form>
    <script src="leaflet/leaflet.js"></script>
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="leaflet/map.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!--<script src="javascript/yearDropDown.js"></script>-->
    <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="jsonfile" id="myFile">
        <button type="submit" name="uploadsubmit">Upload your json file!</button>
    </form>

    <p> Το συνολικό σας score είναι: <?= $wholescore ?> <p>

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
