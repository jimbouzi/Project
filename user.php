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
	<link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"/>
        <style>
              #map {height: 50%;
                      width: 50%;
                      margin: "auto"}
        </style>
</head>
<body>
    <div id="map"></div>

	         <p class="fallback">Upload your JSON file: <input name="file" type="file" id="file"></input></p>

        <div class="upBar" id=mapFilters>
        <select name="year" id="year">
            <option value="">Select Year</option> <!--runs with javascript/monthDropDown.js-->
        </select>
        <select name="month" id="month">
            <option selected value='1'>January</option>
            <option value='2'>February</option>
            <option value='3'>March</option>
            <option value='4'>April</option>
            <option value='5'>May</option>
            <option value='6'>June</option>
            <option value='7'>July</option>
            <option value='8'>August</option>
            <option value='9'>September</option>
            <option value='10'>October</option>
            <option value='11'>November</option>
            <option value='12'>December</option>
        </select>
        <select name="day" id="day">
            <option value="1">Monday</option>
            <option value="2">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="4">Thursday</option>
            <option value="5">Friday</option>
            <option value="6">Saturday</option>
            <option value="7">Sunday</option>
        </select>
        <input type="time" id="hours" name="hours">
    </div>





    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/dropzone.min.js"></script>
<script src="lib/leaflet.heat.min.js"></script>
<script src="lib/prettysize.js"></script>
<script src="lib/oboe-browser.min.js"></script>
<script src="index.js?v=3"></script>
<input type="file" id="myFile">
    <input type="submit">


	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55418641-9', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>
