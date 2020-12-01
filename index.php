
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugMe Issue Tracker</title>
    <script type='module' src="./view/js/index.js"></script>
    <link rel="stylesheet" href="view/css/index.css">
    <link rel="stylesheet" href="view/css/login.css">
    <link rel="stylesheet" href="view/css/home.css">
    <link rel="stylesheet" href="view/css/new_user.css">
    <link rel="stylesheet" href="view/css/new_issue.css">
    <link rel="stylesheet" href="view/css/issue.css">
</head>
<body>
    <!--heading of the page-->
    <?php require_once "view/header.php";?>
    <!--main section-->
        
    <!--side bar of the page-->
    <?php require_once "view/side_bar.php";?>
    
    <!--main section of the page-->
    <main>
        <section id="login">
            <h3>SIGN IN</h3>
            <div class="form-field">
                
                <input type="text" name="email" id="email" placeholder="email"> 
            </div>
            <div class="form-field">
                
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <button id=login_button>Login</button>
            <p class="error_msg"></p>
            </div>
        </section>
    </main>
</body>
</html>