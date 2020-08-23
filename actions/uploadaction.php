<?php
if (isset($_POST['uploadsubmit'])){
session_start();
require 'dbfile.php';
$userid = $_SESSION['sesuserId'];
$timest = $lat = $long = $acc = $type = $conf = null;
$strlong1 = array();

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
            $type = $value[0]["activity"][0]["type"];
            $conf = $value[0]["activity"][0]["confidence"];
        break;
      }
		}
		if(isset($type)){
			$str1 = "('".$userid."', '".$timest."', ".$lat.", ".$long.", ".$acc.", '".$type."', ".$conf.")";
		}
		else{
			$str1 = "('".$userid."', '".$timest."', ".$lat.", ".$long.", ".$acc.", NULL, NULL)";
		}
		array_push($strlong1, $str1);
  $timest = $lat = $long = $acc = $type = $conf = null;
 }
}
$insertvalues = implode(", ", $strlong1);
$sql = "INSERT INTO userdata (userid, timestampms, latitude, longtitude, accuracy, type, confidence) VALUES $insertvalues";
if (!mysqli_query($conn, $sql)){
	echo "Error: " . $sql . "<br>" . mysqli_error($conn), "<br>";
	header("Location: ../user.php?upload=error");
	exit();
}
	header("Location: ../user.php?upload=success");
}else{
	header("Location: ../user.php");
}
