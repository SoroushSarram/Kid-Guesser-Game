<?php 
##### Page: Left Section  Include File  #####
##### Purpose: Left Section Menu Box file.#####
##### Description: Here you can define left menu link.#####
?>
  <div class="leftcolumn">
  <h2>Welcome <?php echo $_SESSION['username'];?></h2>
    <p><a href="dashboard.php">Guesser Game</a></p>
    <p><a href="change_password.php">Change Password</a></p>
	<p><a href="dashboard.php?logout=1">Sign Out</a></p>
  </div>