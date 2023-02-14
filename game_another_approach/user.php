<?php
class user {
    private $id;
    private $username;
    private $password;

    public function get_id() {
        return $this->id;
    }

    public function get_username() {
        return $this->username;
    }

    public function get_password() {
        return $this->password;
    }
}
?>