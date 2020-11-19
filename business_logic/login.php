<?php
// check if user has logged in before granting access to script
session_start();
require_once "../db_access/db_conn.php";
$db_conn = new DatabaseConnection();
$isConnected = $db_conn->establishConnection();

if(isset($_GET['email']) && isset($_GET['password'])){
    
    if($isConnected){
        //validate user input
        $email = validateUser($_GET['email'], $_GET['password']);
        if($email){
            //create user session
            $_SESSION['user_id'] = $email['email'];
            // clear error msgs if there were preveious errors
            if(isset($_SESSION['error_msg'])){unset($_SESSION['error_msg']);};
            // redirect to the home page
            header("Location: ../presentation/home_view.php");
        }else{
            // redirect to the login page
            $_SESSION['error_msg'] = 'Incorrect Username or Password';
            header("Location: ../index.php");
        }
    }else{
        // redirect to the login page
        $_SESSION['error_msg'] = 'Failed to connect to the database';
        header("Location: ../index.php");
    }
}

function validateUser($email, $password){
    global $db_conn;
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $password = $password;
    $user = $db_conn->login($email, $password);
    if($user){
        return $user;
    }
    else{return false;}
}
?>