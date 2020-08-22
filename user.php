<?php
session_start();
if(!isset($_SESSION['sesusername'])){
  header("Location: ../index.php");
  exit();
}
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
    <!--Map grid-->
    <div id="mapid"></div>
    
    <!--Calendar -->
    <div class="upBar" id=mapFilters>
        <label for="fromDate">From:</label>
        <input type="date" id="fromDate" name="fromDate" min=<?php
         echo date('Y-m-d');
        ?>> 

        <label for="toDate">To:</label>
        <input type="date" id="toDate" name="toDate" min=<?php
         echo date('Y-m-d');
        ?>> 
    </div>

    <!--Action buttons-->
    <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="jsonfile" id="myFile">
        <button type="submit" name="uploadsubmit">Upload your json file!</button>
    </form>
    <form action="actions/logoutaction.php" method="POST">
      <button type="submit" name="logoutsubmit">Logout</button>
    </form>

    <!--Scripts-->
    <script src="leaflet/leaflet.js"></script>
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="map.js"> </script>
</body>
</html>