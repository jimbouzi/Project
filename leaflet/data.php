<?php
session_start();
require '../actions/dbfile.php';
$userid = $_SESSION['sesuserId'];

$yearFrom = $_POST['yearStart'];
$yearTo = $_POST['yearEnd'];
$monthFrom = $_POST['monthStart'];
$monthTo = $_POST['monthEnd'];

$sql = "SELECT latitude, longtitude, accuracy FROM userdata WHERE
        month >= $monthFrom AND month <= $monthTo AND
        year>=$yearFrom AND year<=$yearTo";
$sqlUserExtra = " AND userid='$userid'";

if($userid != 'admin'){
    $sql = $sql . $sqlUserExtra;
}

function getDataFromDB($connection, $sqlQuery){

    $result = mysqli_query($connection, $sqlQuery);
    $mapData = array();

    while ($row = mysqli_fetch_assoc($result)){

        $mapData[] = $row;
        }

        echo '{"locations" : ';
        echo json_encode($mapData);
        echo '}';
}

getDataFromDB($conn, $sql);
