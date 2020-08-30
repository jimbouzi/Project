<!DOCTYPE html>
<html>
<head>
  <title>Ecofriendly</title>
  <link rel="stylesheet" href="css/w3css.css">
    <link rel="stylesheet" href="css/background.css">
   <link rel="stylesheet" href="css/signup-login.css">
  
</head>







<div class="container" id="container">
	<div class="form-container sign-up-container">
	<form name="form2" action="actions/signupaction.php"
         method="POST" autocomplete="off">
        <center>
         <br>
		 <br>
			 

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

              <label for="userName" style="text-align: center;">Username:
              </label>
              <input type="text"	 name="userName" class="form-input" value="<?php echo $userName;?>">
              
              <label for="name">Name: </label>
              <input type="text" name="name" class="form-input" value="<?php echo $name;?>">
              
              <label for="surname">Surname: </label>
              <input type="text" name="surname" class="form-input" value="<?php echo $surname;?>">
             
              <label for="email">e-mail: </label>
              <input type="text" name="email" class="form-input" value="<?php echo $email;?>">
              
              <label for="passw">Password: </label>
              <input type="password" name="passw" class="form-input">
              
              <label for="passw">Repeat password: </label>
              <input type="password" name="passw2" class="form-input">
              <p></p>
              <input class="form-btn" name="signupsubmit" type="submit" value="Submit" />
        </center></form>	
	</div>
	
	
	<div class="form-container sign-in-container">
	

	
	
		<form name="form1" action="actions/loginaction.php"
           method="POST" autocomplete="off">
		  
          <center>
		  <h1>Log in</h1>
            <?php
              if (isset($_GET['error'])){
                if($_GET['error'] == "loginerror"){
                  echo '<p class="loginerror">Username or password are incorrect.</p>';
                }
                else if($_GET['error'] == "no_user"){
                  echo '<p class="loginerror">There is no user with this username.</p>';
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
	
	
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				
				<h1>Track your every day travels and become more ecofriendly today!</h1>
				<p>Already have an account? Click here to Log in!</p>
				<button class="ghost" id="signIn">Log In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Track your every day travels and become more ecofriendly today!</h1>
				<p>Don't have an account? Click here to Sign up!</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>


<script>

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});





</script>

</div>
</body>
</html>
