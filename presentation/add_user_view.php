<?php
session_start();
// check if user has logged in before granting access to script
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugMe Issue Tracker</title>
    <script src="/js/add_user.js"></script>
</head>
<body>
    <!--heading of the page-->
    <header>
        
    </header>

    <!--side navigation bar-->
    <aside>

    </aside>
    <!--main section-->
    <main>
        <h1>ADD USER PAGE</h1>
    </main>
</body>
</html>