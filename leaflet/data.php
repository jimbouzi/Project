<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecoapp");
//require 'actions/dbfile.php';
$userid = $_SESSION['sesuserId'];

$yearfrom = $_POST['yearStart'];
$yearto = $_POST['yearEnd'];
$monthfrom = $_POST['monthStart'];
$monthto = $_POST['monthEnd'];

$sql = "SELECT latitude, longtitude, accuracy, type FROM userdata WHERE  
            month >= $monthfrom AND month <= $monthto AND 
            year>=$yearfrom AND year<=$yearto";
$sqlUserExtra = " AND userid=$userid";

if($userid != 'admin'){
    $sql = $sql . $sqlUserExtra;
}

function getDataFromDB($connection, $sqlQuery){

    $result = mysqli_query($connection, $sqlQuery);
    $mapData = array();

    while ($row = mysqli_fetch_assoc($result)){

        $row['latitude'] = $row['latitude'];
        $row['longtitude'] = $row['longtitude'];
        $mapData[] = $row;
        }

        echo '{"locations" : ';
        echo json_encode($mapData);
        echo '}';
}

getDataFromDB($conn, $sql);