<?php

class User{

    private $db_conn;
    
    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }
    public function getAllUsers(){
        return $this->db_conn->getAllUsers();
    }

    public function addUser($firstname, $lastname, $email, $password){
        return $this->db_conn->insertUser($firstname, $lastname, $email, $password);
    }
}