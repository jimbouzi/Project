<?php

$conn = mysqli_connect("localhost", "root", "0123456", "ecoapp");
$sql = "SELECT latitude, longtitude, accuracy FROM userdata";

$result = mysqli_query($conn, $sql);

$testData = array();

while ($row = mysqli_fetch_assoc($result))
{
    $row[latitude] = $row[latitude]/10000000;
    $row[longtitude] = $row[longtitude]/10000000;
    $row[accuracy] = $row[accuracy] - 1;
    $testData[] = $row;
}

echo json_encode($testData);