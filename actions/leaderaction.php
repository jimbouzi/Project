<?php
$i = 0;
$flag = 0;
$mintimestamp = "<i> δεν υπάρχουν εγγραφές </i>";
$maxtimestamp = "<i> δεν υπάρχουν εγγραφές </i>";
$lastupload = "<i> δεν υπάρχουν εγγραφές </i>";
$sql = "SELECT userid, name, surname, score FROM users ORDER BY score DESC";
$res = mysqli_query($conn, $sql);
for($z=1; $z<4; $z++){
  //$i++;
  if($row = mysqli_fetch_array($res)){
    if($userid == $row['userid']){  //bold
      $firstsurlettr = mb_substr($row['surname'], 0, 1, 'utf-8');
      echo '<tr> <th>'.$z.'. '.$row['name'].' '.$firstsurlettr.'.</th> <th>'.$row['score'].'</th> </tr>';
      $flag = 1;
    }
    else if($row['userid'] != 'admin'){
      $firstsurlettr = mb_substr($row['surname'], 0, 1, 'utf-8');
      echo '<tr> <td>'.$z.'. '.$row['name'].' '.$firstsurlettr.'.</td> <td>'.$row['score'].'</td> </tr>';
    }
    else
      $z--; //gia na min metraei kai ton admin
  }
}
//an den einai stin top 3ada o user ton vgazei apo katw
//an einai stin top 3ada to parakatw den ekteleitai logw tou flag
if($flag == 0){
  while($row = mysqli_fetch_array($res)){
    if($row['userid'] == 'admin')
      $z--; //gia na min metraei kai ton admin
    if($userid == $row['userid'] && $row['userid'] != 'admin'){  //bold
      $dokimastiko = "123456789";
      $firstsurlettr = mb_substr($row['surname'], 0, 1, 'utf-8');
      echo '<tr> <th>'.$z.'. '.$row['name'].' '.$firstsurlettr.'.</th> <th>'.$row['score'].'</th> </tr>';
    }
    $z++;
  }
}
$sql = "SELECT MIN(timestampms) FROM userdata WHERE userid='$userid'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
if($row['MIN(timestampms)'] > 0)
  $mintimestamp = date("d/m/Y", $row['MIN(timestampms)']/1000);


$sql = "SELECT MAX(timestampms) FROM userdata WHERE userid='$userid'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
if($row['MAX(timestampms)'] > 0)
  $maxtimestamp = date("d/m/Y", $row['MAX(timestampms)']/1000);

$sql = "SELECT lastupload FROM users WHERE userid='$userid'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
if(!is_null($row['lastupload']))
  $lastupload = $row['lastupload'];
