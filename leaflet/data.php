<?php
session_start();
require '../actions/dbfile.php';
$userid = $_SESSION['sesuserId'];

$yearfrom = $_POST['yearStart'];
$yearto = $_POST['yearEnd'];
$monthfrom = $_POST['monthStart'];
$monthto = $_POST['monthEnd'];

$sql = "SELECT latitude, longtitude, accuracy FROM userdata WHERE
            month >= $monthfrom AND month <= $monthto AND
            year>=$yearfrom AND year<=$yearto";
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
