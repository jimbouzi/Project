<?php
use Brick\Db\Bulk\BulkInserter;
if (isset($_POST['uploadsubmit'])){
session_start();
require 'dbfile.php';
$userid = $_SESSION['sesuserId'];
$timest = $lat = $long = $acc = $type = $conf = null;
$strlong1 = array();

require_once (__DIR__.'../../json-machine/vendor/autoload.php');


require_once (__DIR__.'../../brick-db/vendor/autoload.php');


$pdo = new PDO("mysql:host=$servername;dbname=$dBName", $dBUsername, $dBPassword);
$inserter = new BulkInserter($pdo, 'userdata', ['userid', 'timestampms', 'latitude', 'longtitude', 'accuracy', 'type', 'confidence', 'year', 'month', 'day', 'hour'], 10000);
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
          $lat = $value/10000000;
          break;
        case "longitudeE7":
          $long = $value/10000000;
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
		if(validDistance($lat, $long)){
			$xronos = date("Y", $timest/1000);
			$minas = date("m", $timest/1000);
			$mera = date("w", $timest/1000);
			$wra = date("G", $timest/1000);
			if(isset($type)){
        $inserter->queue($userid, $timest, $lat, $long, $acc, $type, $conf, $xronos, $minas, $mera, $wra);
			}
			else{
        $inserter->queue($userid, $timest, $lat, $long, $acc, NULL, NULL, $xronos, $minas, $mera, $wra);
			}
	    $timest = $lat = $long = $acc = $type = $conf = $xronos = $minas = $mera = $wra = null;
		}
 	}
}
$inserter->flush();
$lastupload = date("d/m/Y");
$sql = "UPDATE users SET lastupload='$lastupload' WHERE userid='$userid'";
mysqli_query($conn, $sql);
	header("Location: ../user.php?upload=success");
}else{
	header("Location: ../user.php");
}

function validDistance($distlat, $distlong) {
    $earth_radius = 6371;
		$latitude2 = 38.230462;
		$longtitude2 = 21.753150;

    $dLat = deg2rad($latitude2 - $distlat);
    $dLon = deg2rad($longtitude2 - $distlong);

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($distlat)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;

    if($d > 10)
			return false;
		else
			return true;
}
