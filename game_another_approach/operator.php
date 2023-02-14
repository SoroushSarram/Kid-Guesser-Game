<?php
require_once "repository.php";
require_once "user.php";

class operator {
    private $repository;

    public function __construct() {
        $this->repository = new repository();
    }

    public function validate_username($username) {
        if(empty(trim($username))){
            return "Please enter a username.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))){
            return "Username can only contain letters, numbers, and underscores.";
        } else{
            $user = $this->repository->get_user_by_username(trim($_POST["username"]));
            if($user != null){
                return "This username is already taken.";
            }
        }
    }

    public function validate_password($password) {
        if(empty(trim($password))){
            return "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            return "Password must have at least 6 characters.";
        }
    }

    public function validate_confirm_password($password, $confirm_password, $password_err) {
        if(empty(trim($confirm_password))){
            return "Please confirm password.";     
        } else{
            if(empty($password_err) && ($password != $confirm_password)){
                return "Password did not match.";
            }
        }
    }

    public function create_user($username, $password): user {
        $username = strip_tags($username);
		$username = stripslashes($username);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        return $this->repository->create_user($username, $hashed_password);
    }

    public function validate_login_username($username) {
        if(empty(trim($username))){
            return "Please enter your username.";
        }
    }

    public function validate_login_password($password) {
        if(empty(trim($password))){
            return "Please enter your password.";
        }
    }

    public function get_user_by_username($username): ?user {
        return $this->repository->get_user_by_username($username);
    }

    public function verify_password($password, user $user) {
        return password_verify($password, $user->get_password());
    }

    public function validate_new_password($password) {
        if(empty(trim($password))){
            return "Please enter the new password.";     
        } elseif(strlen(trim($password)) < 6){
            return "Password must have atleast 6 characters.";
        }
    }

    public function update_user($id, $password): user {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $this->repository->update_user($id, $hashed_password);
    }
}
?>