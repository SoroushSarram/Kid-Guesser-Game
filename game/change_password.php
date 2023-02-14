<?php
##### Page: Change Password  #####
##### Purpose: This page is for user change password.#####
##### Description: Here user can change his/her password.#####
ob_start();
session_start();
include_once 'include/game.class.php'; // Include class.
$user = new User(); 
$userid = $_SESSION['userid'];
//Check Authentication
if (!$user->get_session()){
 header("location:index.php");
 exit;
}
// End Authentication
$msg="";
 if (isset($_REQUEST['old_password'])){
 extract($_REQUEST);
 if($password==@$confirm) // Check if old password and new password matched.
 {
 $change_password = $user->change_password($old_password,$password,$userid);
  if ($change_password) {
 // Change Password Success
 $msg = '<h3 class="success">Password changed successfully</h3>';
 } else {
 // Changed Password Failed
 $msg = '<h3 class="error">Change Password failed. Old Password does not match</h3>';
 }
 }
 else 
 { 
$msg = '<h3 class="error">Password and Confirm Password does not match</h3>'; // If password does not match.
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
<div class="row">
 <?php include_once 'include/left.php'; ?> 
   <div class="rightcolumn" >
    <h2>Change Password</h2>
	<form action="change_password.php" method="post">
      <hr>
<?php echo $msg; ?>
    <label for="email"><b>Old Password</b></label>
    <input type="password" placeholder="Enter Old Password" name="old_password" id="old_password" required>
    <label for="psw"><b>New Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <label for="confirm"><b>Confirm New Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confirm" id="confirm" required>
     <button type="submit" class="registerbtn">Update</button>
 
</form>
  </div>
</div>



</body>
</html>
