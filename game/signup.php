<?php
##### Page: Sign-Up  #####
##### Purpose: This page is for user Sign-up.#####
##### Description: Here user can register.#####
	session_start();
	include_once 'include/game.class.php';
	$user = new User();
	$msg="";
 if (isset($_REQUEST['username'])){
 extract($_REQUEST); // Get all post variable
 if($password==@$confirm) // Check password and confirm password match
 {
 $register = $user->reg_user($username,$password);

 if ($register) {
 // Registration Success
 $msg = '<h3 class="success">Registered successfully <a href="index.php">Click here</a> to login</h3>';
 } else {
 // Registration Failed
 $msg = '<h3 class="error">Registration failed. Username already exit please try again</h3>';
 }
 }
 else 
 { 
$msg = '<h3 class="error">Registration failed. Password and Confirm Password does not match</h3>'; 
}
 }	
	
?>	
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<form action="signup.php" method="post">
  <div class="container">
    <h1>Sign-Up</h1>
     <hr>
<?php echo $msg; ?>
    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <label for="confirm"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confirm" id="confirm" required>
    

    <button type="submit" class="registerbtn">Sign-up</button>
	<p>Already have an account? <a href="index.php">Sign-In</a>.</p>
  </div>
  
</form>

</body>
</html>
