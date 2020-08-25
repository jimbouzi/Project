<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecoapp");
//require 'dbfile.php';
$userid = $_SESSION['sesuserId'];


if ($userid == 'admin'){
    //$startMonth = $_GET['monthFrom'];
    $sql = "SELECT latitude, longtitude, accuracy FROM userdata ";
    $sql2 = "WHERE ";
    $sql3 = "month = 1";

    $sqlFinal = $sql . $sql2 . $sql3;      
}else{
    $sql = "SELECT latitude, longtitude, accuracy FROM userdata WHERE userid='$userid'";
}

function getDataFromDB($connection, $sqlQuery){

    $result = mysqli_query($connection, $sqlQuery);
    $mapData = array();

    while ($row = mysqli_fetch_assoc($result)){

        $row['latitude'] = $row['latitude']/10000000;
        $row['longtitude'] = $row['longtitude']/10000000;
        $mapData[] = $row;
        }

    echo json_encode($mapData);
}

getDataFromDB($conn, $sqlFinal);