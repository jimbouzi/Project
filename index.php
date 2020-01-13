<html>
<head>
  <title>Ecofriendly</title>
  <link rel="stylesheet" href="css/w3css.css">
</head>
<body style="background-color: #d9e0e7">

<div class="leftHalf">
  <h1> Be ecofriendly </h1>
</div>
<div class="rightHalf">
  <div class="upBar">
    <form name="form1" action="actions/loginaction.php"
           method="POST" autocomplete="off">
          <center>
            <?php
              if (isset($_GET['error'])){
                if($_GET['error'] == "no_user"){
                  echo '<p class="loginerror">Username or passowrd are incorrect.</p>';
                }
              }
             ?>
              <div class="separation">
              <label for="userName" style="text-align: center">Username:
              </label><br>
              <input type="text" name="nombre" class="form-input"/>
              </div>
              <div class="separation">
              <label for="pass">Password: </label><br>
              <input type="password" name="pass" class="form-input"/>
              </div>
              <input class="form-btn" name="loginsubmit" type="submit" value="Log-in" />
          </center></form>
  </div>



  <form name="form2" action="actions/signupaction.php"
         method="POST" autocomplete="off">
        <center>
              <h2><em> Sign-Up</em></h2>

              <?php
              $userName = $name = $surname = $email = "";
              if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                  echo '<p class="signuperror">Fill in all fields!</p>';
                  if (isset($_GET['userName'])){
                    $userName = $_GET['userName'];
                  }
                  if (isset($_GET['name'])){
                    $name = $_GET['name'];
                  }
                  if (isset($_GET['surname'])){
                    $surname = $_GET['surname'];
                  }
                  if (isset($_GET['email'])){
                    $email = $_GET['email'];
                  }
                }
                else if($_GET['error'] == "invaliduserName"){
                    echo '<p class="signuperror">Invalid username!</p>';
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "invalidname"){
                    echo '<p class="signuperror">Name can contain letters only!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "invalidsurname"){
                    echo '<p class="signuperror">Surname must contain letters only!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "invalidemail"){
                    echo '<p class="signuperror">Invalid e-mail!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    }
                else if($_GET['error'] == "passwordcheck"){
                    echo '<p class="signuperror">Your passwords do not match!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "usertaken"){
                    echo '<p class="signuperror">Username is already taken!</p>';
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "tooshort"){
                    echo '<p class="signuperror">Your password must contain 8 characters or more!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "noNumbers"){
                    echo '<p class="signuperror">Your password must contain at least 1 number!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "noCapitals"){
                    echo '<p class="signuperror">Your password must contain at least on capital letter!</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
                else if($_GET['error'] == "noSpecials"){
                    echo '<p class="signuperror">Your password must contain at least on special character! (@,&,*,$,#)</p>';
                    if (isset($_GET['userName'])){
                      $userName = $_GET['userName'];
                    }
                    if (isset($_GET['name'])){
                      $name = $_GET['name'];
                    }
                    if (isset($_GET['surname'])){
                      $surname = $_GET['surname'];
                    }
                    if (isset($_GET['email'])){
                      $email = $_GET['email'];
                    }
                    }
              }
          ?>

              <label for="userName" style="text-align: center">Username:
              </label>
              <input type="text" name="userName" class="form-input" value="<?php echo $userName;?>">
              <p></p>
              <label for="name">Name: </label>
              <input type="text" name="name" class="form-input" value="<?php echo $name;?>">
              <p></p>
              <label for="surname">Surname: </label>
              <input type="text" name="surname" class="form-input" value="<?php echo $surname;?>">
              <p></p>
              <label for="email">e-mail: </label>
              <input type="text" name="email" class="form-input" value="<?php echo $email;?>">
              <p></p>
              <label for="passw">Password: </label>
              <input type="password" name="passw" class="form-input">
              <p></p>
              <label for="passw">Repeat password: </label>
              <input type="password" name="passw2" class="form-input">
              <p></p>
              <input class="form-btn" name="signupsubmit" type="submit" value="Submit" />
        </center></form>
</div>

<?php
require 'actions/dbfile.php';
$userid = "LzNMcBMsFX3K+zyB1g==";
$timest = $lat = $long = $acc = $actimest = $type = $conf = null;

require_once (__DIR__.'../json-machine/vendor/autoload.php');

$jsondata = \JsonMachine\JsonMachine::fromFile('dokimi2.json');

foreach($jsondata as $property => $valueA){
	foreach ($valueA as $keyA => $val) {
		foreach($val as $key => $value){
			//elements of each object in locations
      switch ($key) {
        case "timestampMs":
          $timest = $value;
          break;
        case "latitudeE7":
          $lat = $value;
          break;
        case "longitudeE7":
          $long = $value;
          break;
        case "accuracy":
          $acc = $value;
          break;
        case "activity":
            for($i = 0; $i<count($value); $i++){
            $actimest = $value[$i]["timestampMs"];
            $type = $value[$i]["activity"][0]["type"];
            $conf = $value[$i]["activity"][0]["confidence"];
            }
        break;
      }
		}
	//inserting data to userdata table
  $sql = "INSERT INTO userdata (userid, timestampms, latitude, longtitude, accuracy) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../index.php?error=insertsqlerror");
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "sssss",$userid, $timest, $lat, $long, $acc);
    mysqli_stmt_execute($stmt);
  }
  //inserting data to activity table
  if (!$actimest == null){
    $sql = "INSERT INTO activity (userid, timestampms, type, confidence) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=insertsqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "ssss",$userid, $actimest, $type, $conf);
      mysqli_stmt_execute($stmt);
    }
  }
  $timest = $lat = $long = $acc = $acctimest = $type = $conf = null;
 }
}
?>



</body>
</html>
