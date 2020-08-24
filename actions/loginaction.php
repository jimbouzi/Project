<?php
if(isset($_POST['loginsubmit'])){
  require 'dbfile.php';
  $usern = $_POST['nombre'];
  $password = $_POST['pass'];
  if (empty($usern) || empty($password)) {
      header("Location: ../index.php?error=emptyfields");
      exit();
  }
  else {
      $sql="SELECT * FROM users WHERE userName=?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt,"s",$usern);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
          /*if ($row['userID'] == 'admin' && $row['pass'] == $password){
            header("Location: ../admin.php?login=success");
            exit();
          }*/
          $pwdCheck = password_verify($password, $row['pass']);
          if($pwdCheck == false){
            header("Location: ../index.php?error=loginerror");
            exit();
          }
          else if($pwdCheck == true){
            if ($row['userID'] == 'admin'){
              session_start();
              $_SESSION['sesuserId']= $row['userID'];
              $_SESSION['sesusername']= $row['userName'];
              header("Location: ../admin.php?login=success");
              exit();
            }
            session_start();
            $_SESSION['sesuserId']= $row['userID'];
            $_SESSION['sesusername']= $row['userName'];
            header("Location: ../user.php?login=success");
            exit();
          }
          else{
            header("Location: ../index.php?error=wrongpwd");
            exit();
          }
        }
        else{
          header("Location: ../index.php?error=no_user");
          exit();
        }
      }
  }
}
else{
  header("Location: ../index.php");
  exit();
}
