<?php 
##### Page: User Class  #####
##### Purpose: This page is for user class.#####
##### Description: Here we are defining all use class functions.#####
include "database.php";
//Define user class
	class User{

		public $db;

		public function __construct(){
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
		}

		/*** for registration process ***/
		public function reg_user($username,$password){

			$username = strip_tags($username);
			$username = stripslashes($username);
			$password = strip_tags($password);
			$password = stripslashes($password);			
			
			$password = md5($password);
			$sql="SELECT * FROM users WHERE username='$username'";
			
			//checking if the username is available in db
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;

			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$sql1="INSERT INTO users SET username='$username', password='$password'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        		return $result;
			}
			else { return false;}
		}

		/*** for login process ***/
		public function check_login($username, $password){

        	$username = strip_tags($username);
			$username = stripslashes($username);
			$password = strip_tags($password);
			$password = stripslashes($password);
			
			$password = md5($password);
			$sql2="SELECT userid,username from users WHERE  username='$username' and password='$password'";

			//checking if the username is available in the table
        	$result = mysqli_query($this->db,$sql2);
        	$user_data = mysqli_fetch_array($result);
        	$count_row = $result->num_rows;

	        if ($count_row == 1) {
	            // this login var will use for the session
	            $_SESSION['login'] = true;
	            $_SESSION['userid'] = $user_data['userid'];
				$_SESSION['username'] = $user_data['username'];
	            return true;
	        }
	        else{
			    return false;
			}
    	}

		/*** for change password process ***/
		public function change_password($old_password,$password,$userid){

			$old_password = strip_tags($old_password);
			$old_password = stripslashes($old_password);
			$password = strip_tags($password);
			$password = stripslashes($password);
			
			$password = md5($password);
			$old_password = md5($old_password);
			$sql="SELECT * FROM users WHERE password='$old_password' and userid ='".$userid."'";
			//checking if the old password matched
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;

			//if the password matched - allow to change password
			if ($count_row == 1){
				$sql1="update users SET password='$password' where userid ='".$userid."'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        		return $result;
			}
			else { return false;}
		}

    	/*** starting the session ***/
	    public function get_session(){
	        return $_SESSION['login'];
	    }
// User Logout Function
	    public function user_logout() {
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }

	}
?>