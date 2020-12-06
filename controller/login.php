<?php
require_once "../model/db_conn.php";

class Login{
    public $db_conn;

    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }

    public function log($email, $password){
        $hashed_password = substr(md5($password), 0, 20);
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        $user = $this->db_conn->login($email, $hashed_password);
        return $user;
    }

}
?>