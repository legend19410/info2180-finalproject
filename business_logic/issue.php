<?php

session_start();
require_once "../db_access/db_conn.php";

if($_SESSION['user_id']){
    //user has been logged in

    // this will deal with all issues: all, open, my ticket and single issues

    // use $_SESSION['user_id'] to get specific issue id for my ticket request
    // check the the get global variable for requested issues
    // sanitize the inputs and add the check to the 
    // database using the database access object for issue 
    // to 

    // use this to send data to the client assoc array with all issue attrubutes if found 
    // else send error message
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