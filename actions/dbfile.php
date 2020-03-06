<?php
$servername= "localhost";
$dBUsername= "root";
$dBPassword = "0123456";
$dBName = "ecoapp";
$conn =  mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if(!$conn){
  die("Connection Failed: ".mysqli_connect_error());
}
?>
