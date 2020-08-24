<?php
$i = 0;
$flag = 0;
$sql = "SELECT userid, name, surname, score FROM users ORDER BY score DESC";
$res = mysqli_query($conn, $sql);
for($z=1; $z<4; $z++){
  //$i++;
  if($row = mysqli_fetch_array($res)){
    if($userid == $row['userid']){  //bold
      echo '<tr> <th>'.$z.'. '.$row['name'].' '.$row['surname'][0].'.</th> <th>'.$row['score'].'</th> </tr>';
      $flag = 1;
    }
    else if($row['userid'] != 'admin')
      echo '<tr> <td>'.$z.'. '.$row['name'].' '.$row['surname'][0].'.</td> <td>'.$row['score'].'</td> </tr>';
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
      echo '<tr> <th>'.$z.'. '.$row['name'].' '.$row['surname'][0].'.</th> <th>'.$row['score'].'</th> </tr>';
    }
    $z++;
  }
}
