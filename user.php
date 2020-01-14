<?php
session_start();
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

    <script src="leaflet/leaflet.js"></script>
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="leaflet/map.js"> </script>
    <form action="actions/uploadaction.php">
    <input type="file" id="myFile">
    <input type="submit">
    </form>
</body>
</html>
