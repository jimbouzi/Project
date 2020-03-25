<?php

$conn = mysqli_connect("localhost", "root", "", "ecoapp");
$sql = "SELECT latitude, longtitude, accuracy FROM userdata limit 0,1000";

$result = mysqli_query($conn, $sql);

$testData = array();

while ($row = mysqli_fetch_assoc($result))
{
    $row['latitude'] = $row['latitude']/10000000;
    $row['longtitude'] = $row['longtitude']/10000000;
    $testData[] = $row;
}

echo json_encode($testData);
