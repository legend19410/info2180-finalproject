<?php
// check if user has logged in before granting access to script
session_start();
require_once "../model/db_conn.php";
require_once "issue.php";
require_once "user.php";
require_once "login.php";
$_SESSION["user"]="";
$db_conn = new DatabaseConnection();

//THIS FIRST IF STATEMENT IS WHAT I WAS TALKING ABOUT
// handle login requests
if (isset($_GET['index'])){

    if(isset($_SESSION['user_id'])){
        echo json_encode(
            array(
                'view' => $_SESSION["view"],
                'loggedIn'=> true,
                'message' => file_get_contents($_SESSION["current_view"])
            )
        ); 
    }
    // not logged in
    else{
        $_SESSION["view"] = "login";//stores current view
        echo json_encode(
            array(
                'view' => $_SESSION["view"],
                'loggedIn'=> false,
                'message' => file_get_contents("../view/login_view.php")
            )
        ); 
    }
}


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
        $_SESSION["user"] = 3;
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["view"] = "home";//stores current view
        $_SESSION["current_view"] = "../view/home_view.php";//stores current view
                                                            //should replace text in file_get_contents when working properly
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents($_SESSION["current_view"])
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


// handle request for the home view page
if(isset($_GET['home-view'])){
    // if user logged in send page to client else send index page
    if(isset($_SESSION["user_id"])){
        $_SESSION["view"] = "home";//stores current view
        $_SESSION["current_view"] = "../view/home_view.php";//stores current view
                                                            //should replace text in file_get_contents when working properly
        echo json_encode(
            array(
                'sess' => session_id(),//should be removed
                'loggedIn'=> true,
                'message' => file_get_contents($_SESSION["current_view"])
  
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

// handle request for available issues
if(isset($_GET['issues']) && isset($_SESSION["user_id"])){
    
    //create issue object to deal with issue requests
    $issue = new Issue($db_conn);
    if($_GET['issues'] === 'all-btn'){
        $issue->getAllIssues();  //return all issues
    }elseif($_GET['issues'] === 'open-btn'){ 
        $issue->getOpenIssues(); //return Open issues
    }elseif($_GET['issues'] === 'my-ticket-btn'){
        $issue->getMyTicketIssues($_SESSION['user_id']); //return current user issues
    }elseif($_GET['issues'] === 'single-issue'){
        $issue->getIssue($_GET['issue-id']); // handle request for a single issue
    }
}

// handle request for add issue page
if(isset($_GET['add_issue'])){
    
    // if user logged in return to client the add issue page
    if(isset($_SESSION['user_id'])){
        $users = new User($db_conn);
        $userList = $users->getAllUsers();
        $_SESSION["view"] = "addIssue";//stores current view
        $_SESSION["current_view"] = "../view/new_issue_view.php";
        echo json_encode(
            array(
                'loggedIn'=> true,
                'view'=> $_SESSION["view"],
                'users' => json_encode($userList),
                'message' => file_get_contents($_SESSION["current_view"])
            )
        ); 
    }else{ // else return the index page
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../index.php")
            )
        ); 
    }
    
}

// handles request to add new users to the system
if(isset($_GET['new-user'])){
    
    // if user is currently logged in check if user if the admin. Only admin is allowed to
    // add new users to the system
    if(isset($_SESSION['user_id'])){
        if($_SESSION['user_id'] === '1'){
            $_SESSION["view"] = "addUser";//stores current view
            $_SESSION["current_view"] = "../view/add_user_view.php";
            echo json_encode(
                array(
                    'loggedIn'=> true,
                    'message' => file_get_contents($_SESSION["current_view"])
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

// handles logout requests
if(isset($_GET['logout'])){
    // logout, clear user session and return login page
    session_unset();
    session_destroy();
    echo file_get_contents("../view/login_view.php");
}


if(isset($_POST['password'])){
    if($_SESSION['user_id'] === '1'){

        $user = new User($db_conn);

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $msg = $user->addUser($firstname, $lastname, $email, $password);

        $response = array(
            'status'=> true,
            'message' => "Added User Successfully"
        );
        echo json_encode($response);
    }
    else{
        echo json_encode(
            array(
                'status'=> false,
                'message' => 'You dont have permission for this'
            )
        );
    }
}


//This should handle request for to enter a issue into the database
if(isset($_POST['description'])){
    $created_by = $_SESSION["user_id"]; 
    $issue = new Issue($db_conn);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $priority = $_POST['priority'];
    $assigned_to = $_POST['assigned_to'];
    $msg = $issue->createIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    $response = array(
        'status'=> true,
        'message' => "Added Successfully"
    );
    echo json_encode($response);
}

if(isset($_GET['close-issue'])){
    $id = htmlspecialchars($_GET['close-issue']);
    $issue = new Issue($db_conn);
    $msg = $issue->closeIssue($id);
    echo $msg;
}

if(isset($_GET['progress-issue'])){
    $id = htmlspecialchars($_GET['progress-issue']);
    $issue = new Issue($db_conn);
    $msg = $issue->progressIssue($id);
    echo $msg;
}