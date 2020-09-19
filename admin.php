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
  <!--For leaflet.draw mono gia user
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
  -->
  <style>
    #mapid {
      height: 70%;
      width: 70%;
      margin: "auto"
    }
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

  <!--<p class="fallback">Upload your JSON file: <input name="file" type="file" id="file"></input></p> -->

  <form action="actions/confirm_delete.php" method="POST" enctype="multipart/form-data">
    <button onclick="return confirm('Are you sure you want to delete the data from the Database?')">Delete Data</button>
  </form>

    <form action="actions/exportaction.php" method="POST">
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
        <option value=3>Wednesday </option>
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

      <label for='movement' id='movement'> Type of movement
        <input type='checkbox' id='stillValue' value='STILL' name='movementCheckbox[]'>Still</input>
        <input type='checkbox' id='tiltingValue' value='TILTING' name='movementCheckbox[]'>Tilting</input>
        <input type='checkbox' id='onFootValue' value='ON_FOOT' name='movementCheckbox[]'>On Foot</input>
        <input type='checkbox' id='inVehicleValue' value='IN_VEHICLE' name='movementCheckbox[]'>In Vehicle</input>
        <input type='checkbox' id='onBicycleValue' value='ON_BICYCLE' name='movementCheckbox[]'>On Bicycle</input>
        <input type='checkbox' id='unknownValue' value='UNKNOWN' name='movementCheckbox[]'>Unknown</input>
      </label>


      <br>

      <input type='button' onclick = "ajaxCall()" value='Choose Filters'>
      <br>
      <button type='submit' name ="exportbutton">Export Data</button>

    </form>

    <script src="leaflet/leaflet.js"></script>
    
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="leaflet/map.js"> </script>
    <script src="javascript/yearDropDown.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <br>
    <!--leaflet.draw xreiazetai mono ston user
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
    -->
    <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="jsonfile" id="myFile">
      <button type="submit" name="uploadsubmit">Upload your json file!</button>
    </form>

    <?php require "actions/adminVisual.php"; ?>
    <div>
      <div style="width:50%; float: left; margin-left:1%;">
        <canvas id="chart1" width="500" height="150"></canvas>
      </div>
      <div class="tables" style="margin-left:55%;">
        <h3>Πλήθος Εγγραφών Ανά Χρήστη</h3>
        <table style = "width:40%">
          <tr>
            <th>Username</th>
            <th>Εγγραφές</th>
          </tr>
          <?= $dataPerUser?>
        </table>
      </div>
    </div>
    <br>
    <div>
      <div style="width:50%; float: left; margin-left:1%;">
        <canvas id="chart2" width="500" height="150"></canvas>
      </div>
      <div style="margin-left: 55%;">
        <canvas id="chart3" width="500" height="150"></canvas>
      </div>
    </div>
    <br>
    <div>
      <div style="width:50%; float: left; margin-left:1%;">
        <canvas id="chart4" width="500" height="150"></canvas>
      </div>
      <div style="margin-left: 55%;">
        <canvas id="chart5" width="500" height="150"></canvas>
      </div>
    </div>
    <script type="text/javascript">

    new Chart(document.getElementById("chart1").getContext('2d'), {
      type: 'bar',
      data: {
        labels: <?= json_encode($movementTypes); ?>,
        datasets: [{
            data: <?= json_encode($movementCount); ?>,
            borderColor: "#F5DEB3",
            backgroundColor: '#136034',
            borderWidth: 3,
            borderColor: '#134434',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000',
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Κατανομή δραστηριοτήτων'
        },
        scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Ποσοστό %'
            }
          }]
        },
        legend: {
          display: false
        }
      }
    });
    new Chart(document.getElementById("chart2").getContext('2d'), {
      type: 'bar',
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            data: <?= json_encode($dataPerMonth) ?>,
            borderColor: "#F5DEB3",
            backgroundColor: '#136034',
            borderWidth: 3,
            borderColor: '#134434',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000',
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Πλήθος Εγγραφών Ανά Μήνα'
        },
        legend: {
          display: false
        }
      }
    });

    new Chart(document.getElementById("chart3").getContext('2d'), {
      type: 'bar',
      data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
            data: <?= json_encode($dataPerDay) ?>,
            borderColor: "#F5DEB3",
            backgroundColor: '#136034',
            borderWidth: 3,
            borderColor: '#134434',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000',
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Πλήθος Εγγραφών Ανά Μέρα Εβδομάδας'
        },
        legend: {
          display: false
        }
      }
    });
    new Chart(document.getElementById("chart4").getContext('2d'), {
      type: 'line',
      data: {
        labels: <?=json_encode($hour) ?>,
        datasets: [{
            data: <?= json_encode($dataPerHour) ?>,
            borderColor: "#F5DEB3",
            backgroundColor: '#136034',
            borderWidth: 3,
            borderColor: '#134434',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000',
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Πλήθος Εγγραφών Ανά Ώρα'
        },
        legend: {
          display: false
        }
      }
    });
    new Chart(document.getElementById("chart5").getContext('2d'), {
      type: 'line',
      data: {
        labels: <?=json_encode($yeararray) ?>,
        datasets: [{
            data: <?= json_encode($dataPerYear) ?>,
            borderColor: "#F5DEB3",
            backgroundColor: '#136034',
            borderWidth: 3,
            borderColor: '#134434',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000',
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Πλήθος Εγγραφών Ανά Έτος'
        },
        legend: {
          display: false
        }
      }
    });
    </script>
    <br>
    <br>
    <div>
      <form action="actions/logoutaction.php" method="POST">
        <button type="submit" name="logoutsubmit">Logout</button>
      </form>
    </div>
    <form action="actions/adminVisual.php" method="POST">
      <button type="submit" name="chartbutton">Chart!</button>
    </form>
</body>

</html>
