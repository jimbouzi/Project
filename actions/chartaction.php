<?php
require 'dbfile.php';

$ecoarray = array('STILL', 'ON_FOOT', 'WALKING', 'RUNNING', 'ON_BICYCLE');
$monthlabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$temparray = array_fill(1, 12, array_fill(0, 2, 0));
$chartdata =array();
$currmonth = date("m");
$curryear = date("Y");
$wholecount = $ecowholecount = 0;
$userid = $_SESSION['sesuserId'];
$sql = "SELECT timestampms, type FROM activity WHERE userid='$userid'";
$res = mysqli_query($conn, $sql);
//silogi dedomenon apo tin vasi
while($row = mysqli_fetch_array($res)){
  $month = date("m", $row['timestampms']/1000)-0;
  if($curryear == date("Y", $row['timestampms']/1000)){
    $wholecount++;
    $temparray[$month][0]++;
    if(in_array($row['type'], $ecoarray)){
      $temparray[$month][1]++;
      $ecowholecount++;
    }
  }
  else if($curryear-1 == date("Y", $row['timestampms']/1000)){
    if($currmonth < $month){
      $wholecount++;
      $temparray[$month][0]++;
      if(in_array($row['type'], $ecoarray)){
        $temparray[$month][1]++;
        $ecowholecount++;
      }
    }
  }else{
    $wholecount++;
    if(in_array($row['type'], $ecoarray)){
      $ecowholecount++;
    }
  }
}
//ypologismos score kathe mina
for($i=1; $i<=count($temparray); $i++){
  if($temparray[$i][0] != 0){
    array_push($chartdata, round(($temparray[$i][1]/$temparray[$i][0])*100));
  }
  else {
    array_push($chartdata, 0);
  }
}
//shiftarisma pinaka wste o teleutaios minas na einai pio deksia kai na einai pio wraio :)
for($a=0; $a<12-date("m"); $a++){
  array_unshift($monthlabels, array_pop($monthlabels));
  array_unshift($chartdata, array_pop($chartdata));
}
//ypologismos sinolikou score
$wholescore = 0;
if ($wholecount != 0){
  $wholescore = round(($ecowholecount/$wholecount)*100);
}
