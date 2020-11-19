<?php
session_start();
require_once "../db_access/db_conn.php";

if($_SESSION['user_id']){
    //user has been logged in
    // check the the post global variable for inputs
    // sanitize the inputs and add the new user to the 
    // database using the database access object

    // use this to echo a messge to the client
    //         echo json_encode(
    //             array(
    //                 'message' => 'some error message';
    //             )
    //         ); 
    // remember, all data sent to the client should be encapsulated in json (MVC for separation of layers)
    // no HTML on backend

}else{
    //prevent direct access to script
    // redirect to login
    header("Location: ../index.php");
}
