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
        $hash = substr(md5($password), 0, 20);
        $query = $this->handler->query("SELECT * FROM users WHERE email='$email' and password='$hash'");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    // insert a new user into the database
    public function insertUser($first_name, $last_name, $email, $password){
        $hash = substr(md5($password), 0, 20);

        $first_name = htmlspecialchars($first_name);
        $email = htmlspecialchars($email);
        $last_name = htmlspecialchars($last_name);

        $stm = "INSERT 
            INTO users 
                    (
                        firstname, 
                        lastname,
                        email,
                        password,
                        date_joined
                    )
            VALUES (
                    :fname, 
                    :lname,   
                    :email, 
                    :password,
                    NOW()
                    )";
            $query = $this->handler->prepare($stm);
            $query->bindParam(':fname', $first_name );
            $query->bindParam(':lname', $last_name);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $hash);
            $msg = $query->execute();

            return $msg;
    }

    public function insertIssue($title, $description, $type, $priority, $assigned_to, $created_by){
        $stm = "INSERT 
                    INTO issues 
                            (title, 
                            description, 
                            type, 
                            priority,
                            status, 
                            assigned_to, 
                            created_by,
                            created, 
                            updates)
                    VALUES (
                            :title, 
                            :description,   
                            :type, 
                            :priority,
                            'OPEN',
                            :assigned_to,
                            :created_by,
                            NOW(),
                            NOW()
                            )";
        $query = $this->handler->prepare($stm);
        $query->bindParam(':title', $title );
        $query->bindParam(':description', $description);
        $query->bindParam(':type', $type);
        $query->bindParam(':priority', $priority);
        $query->bindParam(':assigned_to', $assigned_to);
        $query->bindParam(':created_by', $created_by);
        $msg = $query->execute();
        return $msg;
    }

    //return associative array with all issues
    public function getAllIssues(){
        // echo "reached here";
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return array();
        }
    }

    public function getOpenIssues(){
        // echo "reached here";
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id
                                        WHERE status='OPEN'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return array();
        }
    }

    public function getMyTicketIssues($user_id){
        // returns the all of current user's issues
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id 
                                        where assigned_to=$user_id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return array();
        }
    }

    //return associative array with issue of given id
    public function getIssue($id){
        $id =  htmlspecialchars($id);
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to, created_by, updates, priority FROM issues JOIN users ON issues.assigned_to=users.id 
                                        WHERE issues.id=$id");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return array();            ;
        }
    }

    public function getAllUsers(){
        
        $query = $this->handler->query("SELECT id, firstname, lastname FROM users");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return array();
        }
    }

    public function closeIssue($id){
        $query = $this->handler->query("UPDATE issues SET status = 'CLOSED', updates = NOW() WHERE id=$id");
        if($query->rowCount()==1){
            return true;
        }
        return false;
    }

    public function progressIssue($id){
        $query = $this->handler->query("UPDATE issues SET status = 'IN PROGRESS', updates = NOW() WHERE id=$id");
        if($query->rowCount()==1){
            return true;
        }
        return false;
    }

    public function getNameOfUser($id){
        $query = $this->handler->query("SELECT firstname, lastname FROM users WHERE id = $id");
        $name = $query->fetch(PDO::FETCH_ASSOC);
        if($name){
            return $name;
        }
        else{
            return array();
        }
    }
}

?>