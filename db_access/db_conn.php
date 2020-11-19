<?php

class DatabaseConnection{

    public $handler;

    public function establishConnection(){

        //establish connection with database when called on object
        try{
            $this->handler = new PDO('mysql:host=localhost;dbname=bugstracker', 'root', '');
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    //returns an assoc arr of a valid user or  if given user not valid false 
    public function login($email, $password){
        $query = $this->handler->query("SELECT * FROM users where email='$email' and password='$password'");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if(count($result) === 0){
            return false;
        }
        else{
            return $result;
        }

    }
    
    // insert a new user into the database
    public function insertUser($first_name, $last_name, $password, $email){

    }

    //return associative array with all issues
    public function getAllIssues(){
        
    }

    //return associative array with issue of given id
    public function getIssues($id){

    }

    // more methods 
    //for all open issues
    // etc 
}


?>