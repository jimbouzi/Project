<?php
/*
session_start();
if(!isset($_SESSION['sesusername'])){
  header("Location: ../index.php");
  exit();
}
*/
?>

<html>

<head>
  <meta charset="UTF-8">
  <title>Admin Page</title>
  <h1 style="text-align:center">Welcome to the admin page, adminare!</h1>
  <link rel="stylesheet" href="css/w3css.css" />
  <link rel="stylesheet" href="leaflet/leaflet.css" />
  <style>
    #mapid {
      height: 50%;
      width: 50%;
      margin: "auto"
    }
  </style>
</head>

<body>
  <div id="mapid"></div>

  <!--<p class="fallback">Upload your JSON file: <input name="file" type="file" id="file"></input></p> -->

  <form action="actions/confirm_delete.php" method="POST" enctype="multipart/form-data">
    <button onclick="return confirm('Are you sure you want to delete the data from the Database?')">Delete Data</button>
  </form>

  <form name="Filter" method="POST">
    From:
    <input type="date" name="dateFrom" />
    <br />
    To:
    <input type="date" name="dateTo" />
    <input type="submit" name="submit" value="Show dates as timestampms" />


    <?php
      	$from_date = strtotime($_POST['dateFrom']);
      	echo $from_date;

        echo "<br>";
        
      	$to_date= strtotime($_POST['dateTo']);
      	echo $to_date;

        require 'actions/dbfile.php';

        $sql = "SELECT timestampms FROM userdata WHERE timestampms >= $from_date && timestampms <= $to_date";
        $result = $conn->query($sql);

        if($result -> num_rows>0){

          while($row = $result -> fetch_assoc()){
            echo $row["timestampms"];
            echo "<br>";
          }
        }
      	?>

    <form>
      <label for="yearFrom">Year from:</label>
      <select name="yearFrom" id="yearFrom">
      </select>

      <label for="yearTo">Year to:</label>
      <select name="yearTo" id="yearTo">
      </select>
    </form>
    <br>

        <form>
        <label for="monthFrom">Month from:</label>
          <select name="MonthFrom" id="monthFrom">
          <option value = 1>January </option>
          <option value = 2>February </option>
          <option value = 3>March </option>
          <option value = 4>April </option>
          <option value = 5>May </option>
          <option value = 6>June </option>
          <option value = 7>July </option>
          <option value = 8>August </option>
          <option value = 9>September </option>
          <option value = 10>October </option>
          <option value = 11>November </option>
          <option value = 12>December </option>
          </select>

          <label for="monthTo">Month To:</label>
          <select name="MonthTo" id="monthTo">
          <option value = 1>January </option>
          <option value = 2>February </option>
          <option value = 3>March </option>
          <option value = 4>April </option>
          <option value = 5>May </option>
          <option value = 6>June </option>
          <option value = 7>July </option>
          <option value = 8>August </option>
          <option value = 9>September </option>
          <option value = 10>October </option>
          <option value = 11>November </option>
          <option value = 12>December </option>
          </select>
        </form>


        <form>
        <label for="dayFrom">Day From:</label>
          <select name="dayFrom" id="dayFrom">
          <option value = 0>Sunday </option>
          <option value = 1>Monday </option>
          <option value = 2>Tuesday </option>
          <option value = 3>wednesday </option>
          <option value = 4>Thursday </option>
          <option value = 5>Friday </option>
          <option value = 6>Saturday </option>
          </select>

          <label for="dayTo">Day To:</label>
          <select name="dayTo" id="dayTo">
          <option value = 0>Sunday </option>
          <option value = 1>Monday </option>
          <option value = 2>Tuesday </option>
          <option value = 3>wednesday </option>
          <option value = 4>Thursday </option>
          <option value = 5>Friday </option>
          <option value = 6>Saturday </option>
          </select>
        </form>

        <form> 
        <label for="hourFrom">Hour from:</label>
          <select name="hourfrom" id="hourFrom">
          <option value = 0>0 </option>
          <option value = 1>1 </option>          
          </select>
        </from>

        <br>

        

    <form action="/action_page.php">
      <label for="movement">Type of movement:</label>
      <select name="movement" id="movement">
        <option value="Walk">Walk</option>
        <option value="Run">Run</option>
        <option value="Bike">Bike</option>
        <option value="Car">Car</option>
      </select>
    </form>
  </form>

  <script src="leaflet/leaflet.js"></script>
  <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
  <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
  <script src="leaflet/map.js"> </script>
  <script src="javascript/yearDropDown.js"></script>
  <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="jsonfile" id="myFile">
    <button type="submit" name="uploadsubmit">Upload your json file!</button>
  </form>

  <div class="container" style="width:900px;">
    <br /><br />
    <div id="chart"></div>
  </div>

  <form action="actions/logoutaction.php" method="POST">
    <button type="submit" name="logoutsubmit">Logout</button>
  </form>
  <form action="actions/chartaction.php" method="POST">
    <button type="submit" name="chartbutton">Chart!</button>
  </form>
</body>

</html>