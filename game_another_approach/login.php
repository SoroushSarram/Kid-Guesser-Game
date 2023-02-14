<!--
Group 6
Zahra Mirzaagha
Soroush Sarram
Alireza Ahmadian
-->

<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include files
require_once "operator.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
$operator = new operator();
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    $username_err = $operator->validate_login_username($_POST["username"]);
    if (empty($username_err)) {
        $username = $_POST["username"];
    }
    
    // Check if password is empty
    $password_err = $operator->validate_login_password($_POST["password"]);
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        $user = $operator->get_user_by_username($username);

        if ($user == null) {
            // Username doesn't exist, display a generic error message
            $login_err = "You entered a wrong username!";
        } elseif($operator->verify_password($_POST["password"], $user)){
            // Password is correct, so start a new session
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->get_id();
            $_SESSION["username"] = $username;                            
            
            // Redirect user to welcome page
            header("location: welcome.php");
        } else{
            // Password is not valid, display a generic error message
            $login_err = "You entered a wrong password!";
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Welcom to Login Form</h2>
        <p>Please Enter your username and password.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <table>
                    <tr>
                        <td><input type="submit" class="btn btn-primary" value="Connec"></td>
                        <td><a href="register.php" class="btn btn-primary">Sign-Up</a> </td>
                    </tr>
                </table>
            </div>

        </form>
    </div>
</body>
</html>