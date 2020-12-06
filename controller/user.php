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
        
        $hashed_password = substr(md5($password), 0, 20);
        $first_name = htmlspecialchars($firstname);
        $email = htmlspecialchars($email);
        $lastname = htmlspecialchars($lastname);

        return $this->db_conn->insertUser($firstname, $lastname, $email, $hashed_password);
    }
}