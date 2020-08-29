<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecoapp");
//require 'dbfile.php';
$userid = $_SESSION['sesuserId'];


if ($userid == 'admin'){
    $startMonth = $_POST['monthStart'];
    $sql = "SELECT latitude, longtitude, accuracy FROM userdata ";
    $sql2 = "WHERE ";
    $sql3 = "month >= ";

    $sqlFinal = $sql . $sql2 . $sql3 . $startMonth;
}else{
    $yearfrom = $_POST['yearStart'];
    $yearto = $_POST['yearEnd'];
    $monthfrom = $_POST['monthStart'];
    $monthto = $_POST['monthEnd'];
    $sqlFinal = "SELECT latitude, longtitude, accuracy FROM userdata WHERE userid='$userid' AND month >= $monthfrom AND month <= '$monthto' AND year>='$yearfrom' AND year<='$yearto'";
}

function getDataFromDB($connection, $sqlQuery){

    $result = mysqli_query($connection, $sqlQuery);
    $mapData = array();

    while ($row = mysqli_fetch_assoc($result)){

        $row['latitude'] = $row['latitude']/10000000;
        $row['longtitude'] = $row['longtitude']/10000000;
        $mapData[] = $row;
        }

        echo '{"locations" : ';
        echo json_encode($mapData);
        echo '}';
}

getDataFromDB($conn, $sqlFinal); //anti gia $sql, 8a valoume $sqlFinal
