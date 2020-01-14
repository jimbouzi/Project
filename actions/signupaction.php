<?php

 if(isset($_POST['signupsubmit'])){
   require 'dbfile.php';
   $usern = $_POST['userName'];
   $nam = $_POST['name'];
   $surnam = $_POST['surname'];
   $mail = $_POST['email'];
   $password = $_POST['passw'];
   $password2 = $_POST['passw2'];

  if(empty($usern) || empty($nam) || empty($surnam) || empty($mail) || empty($password) || empty($password2)){
    header("Location: ../index.php?error=emptyfields&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
    exit();
  }
  else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $usern)){
  header("Location: ../index.php?error=invalidmail&uid=");
  exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $usern)){
    header("Location: ../index.php?error=invaliduserName&name=".$nam."&surname=".$surnam."&email=".$mail);
    exit();
  }
  else if (!preg_match("/^[a-zA-Z]*$/", $nam)){
    header("Location: ../index.php?error=invalidname&userName=".$usern."&surname=".$surnam."&email=".$mail);
    exit();
  }
  else if (!preg_match("/^[a-zA-Z]*$/", $surnam)){
    header("Location: ../index.php?error=invalidsurname&userName=".$usern."&name=".$nam."&email=".$mail);
    exit();
  }
  else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    header("Location: ../index.php?error=invalidemail&userName=".$usern."&name=".$nam."&surname=".$surnam);
    exit();
  }
  else if (!validatePassword($password)){
    exit();
  }
  else if ($password !== $password2) {
    header("Location: ../index.php?error=passwordcheck&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
    exit();
  }
  else{
  $sql = "SELECT userID FROM users WHERE userName=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../index.php?error=sqlerror");
    exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $usern);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0){
        header("Location: ../index.php?error=usertaken&name=".$nam."&surname=".$surnam."&email=".$mail);
        exit();
      }
      else{
        $sql = "INSERT INTO users (userID, userName, name, surname, email, pass) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $ciphering = "AES-256-CFB";
        $encryption_iv = random_bytes(openssl_cipher_iv_length($ciphering));
        $userid = openssl_encrypt($mail, $ciphering, $password, '0', $encryption_iv);

         mysqli_stmt_bind_param($stmt, "ssssss",$userid, $usern, $nam, $surnam, $mail, $hashedPwd);
         mysqli_stmt_execute($stmt);
         header("Location: ../user.php?signup=success");
         exit();
        }
      }
    }
  }
 }
 else{
   header("Location: ../index.php");
   exit();
 }

function validatePassword($pass){
  global $usern;
  global $nam;
  global $surnam;
  global $mail;

    if(strlen($pass) < 8){
      echo "Clave demasiado pequeña.";
      header("Location: ../index.php?error=tooshort&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
      return false;
    }
    else if(!preg_match('/[1-9]/',$pass)){
      echo "No contiene ningún número";
      header("Location: ../index.php?error=noNumbers&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
      return false;
    }
    else if(!preg_match('/[A-Z]/',$pass)){
      echo "No tiene mayúsculas";
      header("Location: ../index.php?error=noCapitals&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
      return false;
    }
    else if(!preg_match('/[@&*$#]/',$pass)){
      echo "No contiene caracteres especiales";
      header("Location: ../index.php?error=noSpecials&userName=".$usern."&name=".$nam."&surname=".$surnam."&email=".$mail);
      return false;
    }
    else{
      return true;
    }
}
