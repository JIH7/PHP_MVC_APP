<?php
$cookie_name="id";
if (isset($_COOKIE[$cookie_name])) {
    include('../View/customerpage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- /Fonts -->
    <script src="../View/login.js"></script>
</head>
<body>
    <h1>Welcome!</h1>
    <div class="login card">
        <form id="login" method="get" action=".">
            <label for="username"><strong>User Name</strong></label>
            <input type="text" name="username" id="username">
            <label for="password"><strong>Password</strong></label>
            <input type="password" name="password" id="password">
            <input type="hidden" name="action" value="login">
            <input type="submit" value="Log in">
            <div>
                <span><a href="?action=signup_page">Create Account</a></span>
            </div>
            
            <?php
                if(!empty($error_message)) {
                    echo $error_message;
                }
            ?>
            
        </form>
    </div>
</body>
</html>