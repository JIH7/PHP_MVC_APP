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
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <script src="../View/signup.js"></script>
</head>
<body>
    <h1>Create Account</h1>
    <div class="signup card">
        <form id="signup" method="get" action=".">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email"
            <?php 
                if (!empty($email))
                    echo ' value='.$email;
            ?>>
            <label for="username">User Name</label>
            <input type="text" name="username" id="username"
            <?php
                if (!empty($uname))
                    echo ' value='.$uname;
            ?>>
            <label for="firstname" class="half">First Name</label>
            <label for="lastname" class="half">Last Name</label>
            <input type="text" name="firstname" id="firstname" class="half"
            <?php
                if (!empty($fname))
                    echo ' value='.$fname;
            ?>
            >
            <input type="text" name="lastname" id="lastname" class="half"
            <?php
                if (!empty($lname))
                    echo ' value='.$lname;
            ?>
            >
            <label for="password1">Password</label>
            <input type="password" name="password1" id="password1"
            <?php
                if (!empty($pass1))
                    echo ' value='.$pass1;
            ?>
            >
            <label for="password2">Re-Enter Password</label>
            <input type="password" name="password2" id="password2"
            <?php
                if (!empty($pass2))
                    echo ' value='.$pass2;
            ?>
            >
            <input type="hidden" name="action" value="signup">
            <input type="submit" value="Create Account">
        </form>
        <?php 
        if(!empty($error_message)) {
            echo '<span id="err-cursor" data-loc='.$error_cursor.'></span>';
            echo $error_message;
        }
        ?>
    </div>
</body>
</html>