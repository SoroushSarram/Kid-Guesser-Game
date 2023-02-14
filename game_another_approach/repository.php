<?php
require_once "config.php";
require_once "user.php";

class repository {
    private $link;

    public function __construct() {
        $this->connect();
        $this->create_db();
        $this->create_table();
    }

    private function connect() {
        /* Attempt to connect to MySQL database */
        $this->link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

        // Check connection
        if($this->link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    private function create_db() {
        if(!$this->link->query(CREATE_DB)) {
            die($this->link->error);
        }

        if (!mysqli_select_db($this->link, DB_NAME)) {
            die($this->link->error);
        }
    }

    private function create_table() {
        if (!$this->link->query(CREATE_TABLE)) {
            die($this->link->error);
        }
    }

    public function get_user_by_id($id): ?user {
        $stmt = $this->link->prepare(GET_USER_BY_ID);
        if (!$stmt) {
            die($this->link->error);
        }
        
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('i', $id);
        
        // Attempt to execute the prepared statement
        if(!$stmt->execute()) {
			die($this->db->error);
		}

        // Get the result
        $result = $stmt->get_result()->fetch_object('user');

        // Close statement
        $stmt->close();

        return $result;
    }

    public function get_user_by_username($username): ?user {
        $stmt = $this->link->prepare(GET_USER_BY_USERNAME);
        if (!$stmt) {
            die($this->link->error);
        }
        
        // Set parameters
        $username = trim($username);

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('s', $username);
        
        // Attempt to execute the prepared statement
        if(!$stmt->execute()) {
			die($this->db->error);
		}

        // Get the result
        $result = $stmt->get_result()->fetch_object('user');

        // Close statement
        $stmt->close();

        return $result;
    }

    public function create_user($username, $password): user {
        $stmt = $this->link->prepare(CREATE_USER);
        if (!$stmt) {
            die($this->link->error);
        }

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('ss', $username, $password);
        
        // Attempt to execute the prepared statement
        if(!$stmt->execute()) {
			die($this->db->error);
		}
        
        // Close statement
        $stmt->close();

        return $this->get_user_by_username($username);
    }

    public function update_user($id, $password): user {
        $stmt = $this->link->prepare(UPDATE_USER);
        if (!$stmt) {
            die($this->link->error);
        }

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('si', $password, $id);
        
        // Attempt to execute the prepared statement
        if(!$stmt->execute()) {
			die($this->db->error);
		}
        
        // Close statement
        $stmt->close();

        return $this->get_user_by_id($id);
    }

    function __destruct() {
        $this->link->close();
    }
}
?>