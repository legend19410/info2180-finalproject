<?php
session_start();
if(isset($_SESSION['error_msg'])){
    $message = $_SESSION['error_msg'];
}else{
    $message = null; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugMe Issue Tracker</title>
</head>
<body>
    <!--heading of the page-->
    <header>

    </header>
    <!--main section-->
    <main>
        <form action='business_logic/login.php'>
            <label for="">Email</label>
            <input type="text" name="email" id="email" placeholder="email">
            <label for="">Password</label>
            <input type="password" name="password" id="password" placeholder="password">
            <button id=submit_button>Submit</button>
        </form>
        <p id="error_msg">
            <?php echo $message;?>
        </p>
        </div>
    </main>
</body>
</html>