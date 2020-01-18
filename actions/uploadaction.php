<?php
if (isset($_POST['uploadsubmit'])){
session_start();
require 'dbfile.php';
$userid = $_SESSION['sesuserId'];
$timest = $lat = $long = $acc = $actimest = $type = $conf = null;

require_once (__DIR__.'../../json-machine/vendor/autoload.php');

$jsondata = \JsonMachine\JsonMachine::fromFile($_FILES['jsonfile']['tmp_name']);

foreach($jsondata as $property => $valueA){
	foreach ($valueA as $keyA => $val) {
		foreach($val as $key => $value){
			//elements of each object in locations
      switch ($key) {
        case "timestampMs":
          $timest = $value;
          break;
        case "latitudeE7":
          $lat = $value;
          break;
        case "longitudeE7":
          $long = $value;
          break;
        case "accuracy":
          $acc = $value;
          break;
        case "activity":
            for($i = 0; $i<count($value); $i++){
            $actimest = $value[$i]["timestampMs"];
            $type = $value[$i]["activity"][0]["type"];
            $conf = $value[$i]["activity"][0]["confidence"];
            }
        break;
      }
		}
	//inserting data to userdata table
  $sql = "INSERT INTO userdata (userid, timestampms, latitude, longtitude, accuracy) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../index.php?error=insertsqlerror1");
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "sssss",$userid, $timest, $lat, $long, $acc);
    mysqli_stmt_execute($stmt);
  }
  //inserting data to activity table
  if (!$actimest == null){
    $sql = "INSERT INTO activity (userid, timestampms, type, confidence) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=insertsqlerror2");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "ssss",$userid, $actimest, $type, $conf);
      mysqli_stmt_execute($stmt);
    }
  }
  $timest = $lat = $long = $acc = $actimest = $type = $conf = null;
 }
}
header("Location: ../user.php?upload=succes");
}else{
	header("Location: ../user.php");
}
