<?php
##### Page: Kids Game  #####
##### Purpose: This page is for Kids guess game.#####
##### Description: Here we are creating kids guess game .#####
ob_start();
session_start(); // Session Initialised
include_once 'include/game.class.php'; // Game Class Calling
$user = new User();
// Only Authorised user can view dashboard. 
$userid = $_SESSION['userid'];
if (!$user->get_session()){ // Check User is registered or not - If not redirect him to home.
 header("location:index.php");
 exit;
}
//End Authentication
//Logout User
if (isset($_GET['logout'])){
 $user->user_logout();
 header("location:index.php");
 }
//End Logout 
 	$output_msg = ""; // Initial output message is blank. 
	if (isset($_REQUEST['gues1'])) // Check form submit or not
	{
	$matched_number = 0; // Total matched point initial value.
	$rand_number_list = ""; // Total rand number initial value.
	$guessed_number= ""; // Total user guessed number initial value.
	
// 1 to 5 option Start: This for loop we are initializing 5 select box from 1	
	for ($i=1; $i<6; $i++) {
	$gues="gues".$i; // Here we are defining variable like $gues1, $gues2 etc.
	$gues=$_POST[$gues]; // Here we are getting all select guess box data	
	$rand_number = rand(1,12); // Initialised random number.
	
	if($gues==$rand_number) { $matched_number = $matched_number + 1; } // If random number and guessed number matched
	//Random Number
	$rand_number_list = $rand_number_list.'-'.$rand_number; // addning rand number in string
	$guessed_number = $guessed_number.'-'.$gues;		// adding user guessed number in string
	}
	//1 to 5 option closed 	
	$rand_number_list = substr($rand_number_list,1); // Here we are eliminating first "-"
	$guessed_number = substr($guessed_number,1); // Here we are eliminating first "-"
	$output_msg = "System Number: ".$rand_number_list."<br>"; // Here we are adding output in message box
	$output_msg = $output_msg."Your Selected Number: ".$guessed_number."<br>"; // Here we are adding output in message box

	if($matched_number<1) { $output_msg =$output_msg.'You guessed none of the numbers we generated! You’re an APPRENTICE guesser! Try again!'; } // If mathed less 0.
	if($matched_number<5 && $matched_number>0) { $output_msg = $output_msg.'You guessed '.$matched_number.' of the numbers we generated! You’re a GOOD guesser!'; } // Matched between 1-5
	if($matched_number==5) { $output_msg = $output_msg.'You guessed none of the numbers we generated! You’re an APPRENTICE guesser! Try again!'; } // All 5 mathed
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
 <?php include_once 'include/left.php'; // Here we are adding left box.  ?> 
  
  <div class="rightcolumn" >
    <h2>Guesser Game</h2>
    <p> <?php 
	print $output_msg;
	?></p>
	<form method="post" action=""> 
	<p>
	<?php 
	//Create 5 Select Box : This for loop we are creating 5 select box and initializing from 1	
	for ($i=1; $i<6; $i++) { $guesselect = "gues".$i;	?>
	<select name="<?php echo $guesselect; ?>" class="selectbox">
	<?php 
//1-12 option initialize : Here we are initializing option box.
	for ($j=0; $j<13; $j++) {  ?><option value="<?php echo $j; ?>" <?php if(@$_REQUEST[$guesselect]==$j) { echo 'selected';}?> ><?php echo $j; ?></option> <?php } //1-5 options closed. ?>
	</select>
	<?php } 
	//End Select Box
	?>
	<button type="submit" class="submit">Submit</button> 
	</p>
	</form>
  </div>
</div>



</body>
</html>
