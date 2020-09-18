<?php
if(isset($_POST['exportbutton']))
{
  session_start();
  require '../actions/dbfile.php';
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=ecoapp.csv');
  $download = fopen("php://output", "w");
  fputcsv($download, array('timestampms', 'latitude', 'longtitude', 'accuracy', 'type', 'confidence', 'userid'));
  $userid = $_SESSION['sesuserId'];
  $yearFrom = $_POST['yearFrom'];
  $yearTo = $_POST['yearTo'];

  $monthFrom = $_POST['monthFrom'];
  $monthTo = $_POST['MonthTo'];

  $dayFrom = $_POST['dayFrom'];
  $dayTo = $_POST['dayTo'];

  $hourFrom = $_POST['hourfrom'];
  $hourTo = $_POST['hourTo'];

  if(isset($_POST['movementCheckbox']))
    $moveArray = $_POST['movementCheckbox'];
  $sqlMoves = "";

  if(!empty($moveArray)){
    for ($i = 0; $i < count($moveArray); $i++){
      if ($moveArray[$i] !== "false"){
        $sqlMoves = $sqlMoves ."type = '". $moveArray[$i] . "' OR ";
      }
    }
  }
  $sqlMoves = substr($sqlMoves, 0, -4);
  $sqlMoves = "(" . $sqlMoves . ")";

  //allagh onomatwn
  $mines = karousoFunction($monthFrom, $monthTo);
  $meres = karousoFunction($dayFrom, $dayTo);
  $ores = karousoFunction($hourFrom, $hourTo);

  //allagh onomatwn mesa sto query
  $sql = "SELECT timestampms, latitude, longtitude, accuracy, type, confidence, userid FROM userdata WHERE
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
}

if (!$res = mysqli_query($conn, $sql)){
	header("Location: ../admin.php?export=error");
	exit();
}
while($row = mysqli_fetch_array($res))
{
  if (isset($row['type'])){
    $tempData = array($row['timestampms'], $row['latitude'], $row['longtitude'], $row['accuracy'], $row['type'], $row['confidence'], $row['userid']);
  }
  else
  {
    $tempData = array($row['timestampms'], $row['latitude'], $row['longtitude'], $row['accuracy'], "NULL", "NULL", $row['userid']);
  }
  fputcsv($download, $tempData);
}
fclose($download);

function karousoFunction($x, $y){
  if($x > $y){
    return "OR";
  } else{
    return "AND";
  }
}
