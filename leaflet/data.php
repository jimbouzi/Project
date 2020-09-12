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

$sql = "SELECT latitude, longtitude, accuracy, type, day, hour FROM userdata WHERE
        month >= $monthFrom AND month <= $monthTo AND
        year>=$yearFrom AND year<=$yearTo";
$sqlUserExtra = " AND userid='$userid'";

if($userid != 'admin'){
    $sql = $sql . $sqlUserExtra;
}

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

    echo '{"userID" : "' ;
    echo $_SESSION['sesuserId'];
    echo '", "locations" : ';
    echo json_encode($mapData);
    echo ', "tableData" : ';
    echo json_encode($tableData);
    echo '}';
}

getDataFromDB($conn, $sql);
