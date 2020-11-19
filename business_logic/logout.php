<?php
session_start();

if($_SESSION['user_id']){
    session_unset();
    session_destroy();
    header(Location:"../index.php");
}else{
    //prevent direct access to script
    //redirect to login
    header(Location:"../index.php");
}