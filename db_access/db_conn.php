<?php

class DatabaseConnection{

    private $handler;

    public function __construct(){

        //establish connection with database when called on object
        try{
            $this->handler = new PDO('mysql:host=localhost;dbname=bugstracker', 'root', '');
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){

        }
    }

    //returns an assoc arr of a valid user or  if given user not valid false 
    public function login($email, $password){
        $query = $this->handler->query("SELECT * FROM users where email='$email' and password='$password'");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    // insert a new user into the database
    public function insertUser($first_name, $last_name, $password, $email){

    }

    // public function insertIssue($title, $description, $type, $priority, $assigned_to, $created_by){
    //     $stm = 'INSERT 
    //                 INTO issues 
    //                         (title, 
    //                         `description`, 
    //                         `type`, 
    //                         priority,
    //                         `status`, 
    //                         assigned_to, 
    //                         created_by,
    //                         created, 
    //                         `updates`)
    //                 VALUES (
    //                         :title, 
    //                         :`description`,   
    //                         :`type`, 
    //                         :priority,
    //                         'OPEN',
    //                         :assigned_to,
    //                         :created_by,
    //                         NOW(),
    //                         NOW()
    //                         )';
    //                         $n = 5;
    //     $query = $this->handler->prepare($stm);
    //     $query->bindParam(':title', $title );
    //     $query->bindParam(':description', $description);
    //     $query->bindParam(':type', $type);
    //     $query->bindParam(':priority', $priority);
    //     $query->bindParam(':assigned_to', $n);
    //     $query->bindParam(':created_by', $n);
    //     //  = $query->execute(array(
    //     //     ':title' => $title, 
    //     //     ':description' => $description,   
    //     //     ':type' => $type, 
    //     //     ':priority' => $priority,
    //     //     ':status' => "OPEN",
    //     //     ':assigned_to' => $assigned_to,
    //     //     ':created_by' => $created_by,
    //     //     ':created' => 'NOW()',
    //     //     ':updates' => 'NOW()'
    //     // )); 
    //     $msg = $query->execute();
    //     return msg;
    // }

    //return associative array with all issues
    public function getAllIssues(){
        // echo "reached here";
        $query = $this->handler->query("SELECT * FROM issues");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    //return associative array with issue of given id
    public function getIssues($id){
       
    }

    // more methods 
    //for all open issues
    // etc 
}


?>