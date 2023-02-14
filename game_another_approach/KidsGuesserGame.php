<!doctype html>

<html>
<head>
    <title>Number Guesser Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700" rel="stylesheet">
<!--    <link rel="stylesheet" href="./style.css">-->
</head>
<body>
<form action="welcome.php" method="POST" >
<div class="game-container">
    <div class="guessing-area">
        <div class="guess user-guess">
            <h1>Kids Guessing Game</h1>
            <h1>Welcome!</h1>
            <div class="guess-title">
                <p class="guess-label">The system will generate 5 random numbers soon</p>
                <p class="guess-label">Select 5 different numbers between 0 to 12 guess them</p>
            </div>
            <table>
                <?php for($k=1;$k<=5;$k++):?>
                    <td>
                        <select name="<?php echo 'userGuess'.$k;?>" id="<?php echo 'userGuess'.$k;?>" class="userGuess" >
                            <?php for($i=0;$i<=12;$i++):?>
                                <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </td>
                <?php endfor;?>
            </table>
            <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
                <a href="logout.php" class="btn btn-primary">SIGN OUT</a>
        </div>
    </div>
</div>
</form>
</body>
</html>
