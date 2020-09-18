<?php
session_start();
require '../actions/dbfile.php';
$userid = $_SESSION['sesuserId'];
class MovementType {
  function MovementType($type, $day, $hour) {
    $this->MovementCount = 1;
    $this->MovementTypeName = $type;
    $this->MovementDay = array_fill(0, 7, 0);
    $this->MovementHour = array_fill(0, 24, 0);
    $this->MovementDay[$day]++;
    $this->MovementHour[$hour]++;
  }
}
class TableData {
  function TableData($type, $percent, $MaxDay, $MaxHour) {
    $this->type = $type;
    $this->percent = $percent;
    $this->MaxDay = $MaxDay;
    $this->MaxHour = $MaxHour;
  }
}
$yearFrom = $_POST['yearStart'];
$yearTo = $_POST['yearEnd'];

$monthFrom = $_POST['monthStart'];
$monthTo = $_POST['monthEnd'];

$dayFrom = $_POST['dayStart'];
$dayTo = $_POST['dayEnd'];

$hourFrom = $_POST['hourStart'];
$hourTo = $_POST['hourEnd'];

$isStill = $_POST['isStill'];
$isTilting = $_POST['isTilting'];
$isOnFoot = $_POST['isOnFoot'];
$isInVehicle = $_POST['isInVehicle'];
$isOnBicycle = $_POST['isOnBicycle'];
$isUnknown = $_POST['isUnknown'];

$moveArray = array($isStill, $isTilting, $isOnFoot, $isInVehicle, $isOnBicycle, $isUnknown);
$sqlMoves = "";

for ($i = 0; $i < count($moveArray); $i++){
  if ($moveArray[$i] !== "false"){
    $sqlMoves = $sqlMoves ."type = '". $moveArray[$i] . "' OR ";
  }
}
$sqlMoves = substr($sqlMoves, 0, -4);
$sqlMoves = "(" . $sqlMoves . ")";

/*synartisi gia na doulevoun ta filters akoma kai otan $monthFrom > $monthTo
H monh allagh pou xreiazetai sthn sql einai to AND na ginetai OR
Douleuei kanonika, xreiazetai kalytero onoma, opws kai oi metavlites
Profanws gia to etos den exei nohma
*/

function karousoFunction($x, $y){
  if($x > $y){
    return "OR";
  } else{
    return "AND";
  }
}

//allagh onomatwn
$mines = karousoFunction($monthFrom, $monthTo);
$meres = karousoFunction($dayFrom, $dayTo);
$ores = karousoFunction($hourFrom, $hourTo);

//allagh onomatwn mesa sto query
$sql = "SELECT latitude, longtitude, accuracy, type, day, hour FROM userdata WHERE
        year>=$yearFrom AND year<=$yearTo AND
        (month >= $monthFrom $mines month <= $monthTo)";

$sqlAdminExtra = " AND (day >= $dayFrom $meres day <= $dayTo)
                   AND (hour >= $hourFrom $ores hour <= $hourTo)";

$sqlUserExtra = " AND userid='$userid'";

if($userid != 'admin'){
    $sql = $sql . $sqlUserExtra;
} else{
  $sql = $sql . $sqlAdminExtra;
  if ($sqlMoves != "()"){
    $sql = $sql . " AND " . $sqlMoves;
  }
}
//echo $sql;
/*if ($sqlMoves != "()"){
  $sql = $sql . " AND " . $sqlMoves;
}*/

function getDataFromDB($connection, $sqlQuery){

    $result = mysqli_query($connection, $sqlQuery);
    $mapData = array();
    $tableData = array();
    $temptableData = array();

    $MovementNum = 0;
    while ($row = mysqli_fetch_assoc($result)){
      $mapData[] = $row;
      $MovementNum++; //synolikos counter gia na vgalei to pososto
      $found = array_search($row['type'], array_column($temptableData, 'MovementTypeName'));
      if($found !== false) //an o tipos kinisis uparxei idi apla au3ise tous counters tis
      {
        $temptableData[$found]->MovementCount++;
        $temptableData[$found]->MovementDay[$row['day']]++;
        $temptableData[$found]->MovementHour[$row['hour']]++;
      }
      else if($row['type'] != NULL) //an den uparxei ftiakse
      {
        array_push($temptableData, new MovementType($row['type'], $row['day'], $row['hour']));
      }
    //opote telika ston temptableData tha uparxoun tosa objects osa kai ta diaforetika idi kinisewn
    }
    foreach($temptableData as $Movement)
    {
      $type = $Movement->MovementTypeName;
      $MaxDay = max($Movement->MovementDay);
      $MaxDay = array_keys($Movement->MovementDay, $MaxDay)[0];
      $MaxHour = max($Movement->MovementHour);
      $MaxHour = array_keys($Movement->MovementHour, $MaxHour)[0];
      $percent = round(($Movement->MovementCount/$MovementNum)*100);
      array_push($tableData, new TableData($type, $percent, $MaxDay, $MaxHour));
    }//pername ta dedomena se neo pinaka me tin morfi pou theloume

    echo '{"sesUserID" : "' ;
    echo $_SESSION['sesuserId'];
    echo '", "locations" : ';
    echo json_encode($mapData);
    echo ', "tableData" : ';
    echo json_encode($tableData);
    echo '}';

  }

getDataFromDB($conn, $sql);
