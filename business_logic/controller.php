<?php
// check if user has logged in before granting access to script
session_start();
require_once "../db_access/db_conn.php";
require_once "issue.php";
require_once "login.php";

$db_conn = new DatabaseConnection();

if(isset($_GET['email']) && isset($_GET['password'])){
    
    // extract user email and password
    $email = $_GET['email'];
    $password = $_GET['password'];

    //create a login object
    $login = new Login($db_conn);
    //attempt to login in 
    $user = $login->log($email, $password);

    // if login successful create user session with user_id and send home page to client in json
    // else send error msg in json
    if($user){
        $_SESSION["user_id"] = $user['email'];
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../presentation/home_view.php")
            )
        ); 
    }
    else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => "Invalid email or password"
            )
        );
    }
    
}

if(isset($_GET['home-view'])){
    
    // if request is received for home page

    if(isset($_SESSION["user_id"])){
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../presentation/home_view.php")
            )
        ); 
    }
    else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../index.php")
            )
        );
    }
}


if(isset($_GET['issues']) && isset($_SESSION["user_id"])){
    $issue = new Issue($db_conn);
    if($_GET['issues'] === 'all-btn'){
        $issue->getAllIssues();
    }elseif($_GET['issues'] === 'open-btn'){
        $issue->getOpenIssues();
    }elseif($_GET['issues'] === 'my-ticket-btn'){
        $issue->getMyTicketIssues($_SESSION['user_id']);
    }
}

if(isset($_GET['add_issue'])){
    
    if(isset($_SESSION['user_id'])){
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../presentation/new_issue_view.php")
            )
        ); 
    }else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../index.php")
            )
        ); 
    }
    
}

if(isset($_GET['new-user'])){
    
    if(isset($_SESSION['user_id'])){
        if($_SESSION['user_id']==='admin@project2.com'){
            echo json_encode(
                array(
                    'loggedIn'=> true,
                    'message' => file_get_contents("../presentation/add_user_view.php")
                )
            ); 
        }else{
            echo json_encode(
                array(
                    'loggedIn'=> true,
                    'message' => "<h1>You do not have permission to add new users</h1>"
                )
            ); 
        } 
    }else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../index.php")
            )
        ); 
    }
    
}

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    echo file_get_contents("../index.php");
}


if(isset($_GET['issue']) && isset($_SESSION['user_id'])){
    $issue = new Issue($db_conn);
    $issue->getIssue($_GET['issue']);
}


if(isset($_POST['description'])){
    $created_by = 5;
    $issue = new Issue($db_conn);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $priority = $_POST['priority'];
    $assigned_to = $_POST['assigned_to'];
    $msg = $issue->createIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    echo json_encode(
        array(
            'status'=> true,
            'message' => "milton"
        )
    );
}




