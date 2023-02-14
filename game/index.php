<?php
##### Page: User Login  #####
##### Purpose: This page is for user sign-in. Here we are calling user class and  check login.#####
##### Description: This page is for user sign-in. Here we are calling user class and  check login.#####
	session_start();
	// Here we are including class
	include_once 'include/game.class.php';
	// Here we are call user class
	$user = new User();
	// Initializing error message empty.
	$msg="";
// Check Username and Password 
	if (isset($_REQUEST['username'])) {
		//We are  extracting all post variable
		extract($_REQUEST);
		//Here checking user is exist or not
	    $login = $user->check_login($username, $password);
		// If user exist he/she will entered in dashboard. If failure it will show registration failure message.
	    if ($login) {
	        // Registration Success
	       header("location:dashboard.php");
	    } else {
	        // Registration Failed
	        $msg = '<h3 class="error">Wrong username or password</h3>';
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
<form action="index.php" method="post">
  <div class="container">
    <h1>Sign-In</h1>
    <hr>
<?php echo $msg; ?>
    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>


    <button type="submit" class="registerbtn">Connect</button> 
	<p>Not have an account? <a href="signup.php">Sign-Up</a>.</p>
  </div>
  
</form>
</body>
</html>
