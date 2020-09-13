<?php
require "dbfile.php";

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi drastiriotitwn twn xrhstwn------//
$sql = "SELECT DISTINCT type FROM userdata";
$res = mysqli_query($conn, $sql);
$whole = 0;
$movementTypes = array();
$movementCount = array();

while($row = mysqli_fetch_array($res))
{
  $type = $row['type'];
  $sql1 = "SELECT COUNT(type) FROM userdata WHERE type = '$type'";
  $res1 = mysqli_query($conn, $sql1);
  $row1 = mysqli_fetch_array($res1);
  if($row['type'] != NULL){
    $whole += $row1['COUNT(type)'];
    array_push($movementTypes, $row['type']);
    array_push($movementCount, $row1['COUNT(type)']);
  }
}
for($i=0; $i<count($movementCount); $i++)
{
  $movementCount[$i] = round(($movementCount[$i]/$whole)*100);
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi drastiriotitwn twn xrhstwn ------//

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana xrhsth ------//
$sql = "SELECT userID, username FROM users";
$res = mysqli_query($conn, $sql);
$dataPerUser = "";

while($row = mysqli_fetch_array($res))
{
  $userid = $row['userID'];
  $sql1 = "SELECT COUNT(timestampms) FROM userdata WHERE userid = '$userid'";
  $res1 = mysqli_query($conn, $sql1);
  $row1 = mysqli_fetch_array($res1);
  if($userid != "admin")
    $dataPerUser .= "<tr><td>".$row['username']."</td> <td>".$row1['COUNT(timestampms)']."</td> </tr>";
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana xrhsth ------//

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana mina -----//
$dataPerMonth = array();

for($i=1; $i<13; $i++)
{
  $sql = "SELECT COUNT(month) FROM userdata WHERE month = $i";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($res);
  array_push($dataPerMonth, $row['COUNT(month)']);
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana mina -----//

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana mera -----//
$dataPerDay = array();

for($i=0; $i<7; $i++)
{
  $sql = "SELECT COUNT(day) FROM userdata WHERE day = $i";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($res);
  array_push($dataPerDay, $row['COUNT(day)']);
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana mera -----//

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana wra -----//
$dataPerHour = array();
$hour = array();

for($i=0; $i<24; $i++)
{
  $sql = "SELECT COUNT(hour) FROM userdata WHERE hour = $i";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($res);
  array_push($hour, $i.":00");
  array_push($dataPerHour, $row['COUNT(hour)']);
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana wra -----//

//-ARXH- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana etos -----//
$dataPerYear = array();
$yeararray = array();

$sql = "SELECT DISTINCT year FROM userdata";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res))
{
  $year = $row['year'];
  $sql1 = "SELECT COUNT(year) FROM userdata WHERE year = $year";
  $res1 = mysqli_query($conn, $sql1);
  $row1 = mysqli_fetch_array($res1);
  array_push($yeararray, $year);
  array_push($dataPerYear, $row1['COUNT(year)']);
}
//-TELOS- Sylogi kai epeksergasia dedomenwn gia katanomi eggrafwn ana etos -----//
