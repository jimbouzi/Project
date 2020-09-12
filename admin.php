<?php

session_start();
/*if(!isset($_SESSION['sesusername'])){
  header("Location: ../index.php");
  exit();
}
*/
?>

<html>

<head>
  <meta charset="UTF-8">
  <title>Admin Page</title>
  <!--To echo Username einai gia na vlepoume an exoume energo session --> 
  <h1 style="text-align:center">Welcome to the admin page, Username: <?php echo $_SESSION['sesusername'] ?></h1>

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

    <form>
      <label for="yearFrom">Year from:</label>
      <select name="yearFrom" id="yearFrom">
      </select>

      <label for="yearTo">Year to:</label>
      <select name="yearTo" id="yearTo">
      </select>

      <input type='button' name='allYears' onclick='getLastDropdownElement("yearTo"), getFirstDropdownElement("yearFrom")' value='All Years'></input>

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
      <select name="MonthTo" id="monthTo">
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

      <input type='button' name='allMonths' onclick='getLastDropdownElement("monthTo"), getFirstDropdownElement("monthFrom")' value='All Months'></input>

      <br>

      <label for="dayFrom">Day From:</label>
      <select name="dayFrom" id="dayFrom">
        <option value=0>Sunday </option>
        <option value=1>Monday </option>
        <option value=2>Tuesday </option>
        <option value=3>wednesday </option>
        <option value=4>Thursday </option>
        <option value=5>Friday </option>
        <option value=6>Saturday </option>
      </select>

      <label for="dayTo">Day To:</label>
      <select name="dayTo" id="dayTo">
        <option value=0>Sunday </option>
        <option value=1>Monday </option>
        <option value=2>Tuesday </option>
        <option value=3>Wednesday </option>
        <option value=4>Thursday </option>
        <option value=5>Friday </option>
        <option value=6>Saturday </option>
      </select>

      <input type='button' name='allDays' onclick='getLastDropdownElement("dayTo"), getFirstDropdownElement("dayFrom")' value='All Days'></input>
      <br>

      <label for="hourFrom">Hour from:</label>
      <select name="hourfrom" id="hourFrom">
        <option value=0>0 </option>
        <option value=1>1 </option>
        <option value=2>2 </option>
        <option value=3>3 </option>
        <option value=4>4 </option>
        <option value=5>5 </option>
        <option value=6>6 </option>
        <option value=7>7 </option>
        <option value=8>8 </option>
        <option value=9>9 </option>
        <option value=10>10 </option>
        <option value=11>11 </option>
        <option value=12>12 </option>
        <option value=13>13 </option>
        <option value=14>14 </option>
        <option value=15>15 </option>
        <option value=16>16 </option>
        <option value=17>17 </option>
        <option value=18>18 </option>
        <option value=19>19 </option>
        <option value=20>20 </option>
        <option value=21>21 </option>
        <option value=22>22 </option>
        <option value=23>23 </option>
      </select>

      <label for="hourTo">Hour To:</label>
      <select name="hourTo" id="hourTo">
      <option value=0>0 </option>
        <option value=1>1 </option>
        <option value=2>2 </option>
        <option value=3>3 </option>
        <option value=4>4 </option>
        <option value=5>5 </option>
        <option value=6>6 </option>
        <option value=7>7 </option>
        <option value=8>8 </option>
        <option value=9>9 </option>
        <option value=10>10 </option>
        <option value=11>11 </option>
        <option value=12>12 </option>
        <option value=13>13 </option>
        <option value=14>14 </option>
        <option value=15>15 </option>
        <option value=16>16 </option>
        <option value=17>17 </option>
        <option value=18>18 </option>
        <option value=19>19 </option>
        <option value=20>20 </option>
        <option value=21>21 </option>
        <option value=22>22 </option>
        <option value=23>23 </option>
      </select>

      <input type='button' name='allHours' onclick='getLastDropdownElement("hourTo"), getFirstDropdownElement("hourFrom")' value='All Hours'></input>

      <br>

      <label for="movement">Type of movement:</label>
      <select name="movement" id="movement">
        <option value="Walk">Walk</option>
        <option value="Run">Run</option>
        <option value="Bike">Bike</option>
        <option value="Car">Car</option>
      </select>

      <input type='button' name='allTypes' value='All Types'></input>

      <br>

      <input type='button' onclick = "ajaxCall()" value='Choose Filters'>

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
