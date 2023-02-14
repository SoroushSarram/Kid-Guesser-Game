<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Kids Guessing Game.</h1>
    <p>
        <a href="password-modification.php" class="btn btn-warning">password modification</a>
        <a href="KidsGuesserGame.php" class="btn btn-success">Start Game</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <?php
    $counter = 0;
    if (isset($_POST['submit'])){
        for($k=1;$k<=5;$k++){
            ${"comGuess".$k} = rand(0,12);
            ${"userGuess".$k} = $_POST['userGuess'.$k];
            if( (int)${"comGuess".$k} === (int)${"userGuess".$k}){
                $counter++;
            }
        }

        if($counter === 0){
            $message1 = "1-Result : You guessed none of the numbers we generated!";
            $message2 = "You’re an APPRENTICE guesser! Try again!";
        }elseif(0 < $counter and $counter < 5){
            $message1 = "2-Result : You guessed $counter of the numbers we generated!";
            $message2 = "You’re a GOOD guesser!";
        }elseif($counter === 5){
            $message1 = "3-Result : You guessed all the numbers we generated!";
            $message2 = "You’re an EXCELLENT guesser!";
        }
            echo "<footer>";
            echo "<div class=\"instructions\">";
            echo    "<div class=\"instructions\">";
            echo         "<h3>1-We generate the numbers  $comGuess1, $comGuess2, $comGuess3, $comGuess4, $comGuess5</h3>";
            echo    "</div>";
            echo    "<div class=\"instructions\">";
            echo         "<h3>2-You guessed the numbers $userGuess1, $userGuess2, $userGuess3, $userGuess4, $userGuess5</h3>";
            echo    "</div>";
            echo    "<div class=\"instructions\">";
            echo         "<h3>$message1</h3>";
            echo         "<h3>$message2</h3>";
            echo    "</div>";
            echo "</div>";
            echo "</footer>";
    }
    ?>
</body>
</html>