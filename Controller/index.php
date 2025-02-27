<?php
require('../Controller/loadenv.php');
require('../Model/database.php');
require('../Model/customer_db.php');

$error_message = ''; // Error messages to be disaplyed on page
function addErrorText($error) {
    global $error_message;
    if ($error_message == '')
        return '<span class="error-text">'.$error.'</span>';
    else
        return '<br><span class="error-text">'.$error.'</span>';
}

$action=filter_input(INPUT_POST, 'action'); // Get route

if($action==NULL) {  // If no post request, check for get request
    $action=filter_input(INPUT_GET, 'action');
    if ($action==NULL) { // If no action parameter from get or post, serve the login page
        $action='login_page';
    }
}

if($action=='login_page') {
    include('../View/login.php');
}
else if ($action=="login") {
    $uname=filter_input(INPUT_GET, 'username');
    $pass=filter_input(INPUT_GET, 'password');
    $customer=login_cust($uname, $pass); // Login function from customer model
    if($customer==NULL) {
        $error_message.=addErrorText('Username does not exist or username and password does not match.');
        include('../View/login.php');
        
    }
    else {
        $id=$customer[0];
        $username=$customer[1];
        $password=$customer[2];
        
        setcookie("id", $id, time()+(86400*30), "/");
        setcookie("username", $username, time()+(86400*30), "/");
        setcookie("password", substr($password, 0, 4), time()+(86400*30), "/");
        
        header('Location: .?action=login_page');
    }
}
else if ($action == "signup_page") {
    include('../View/signup.php');
}
else if ($action == "signup") {
    $email=filter_input(INPUT_GET, "email");
    $uname=filter_input(INPUT_GET, "username");
    $fname=filter_input(INPUT_GET, "firstname");
    $lname=filter_input(INPUT_GET, "lastname");
    $pass1=filter_input(INPUT_GET, "password1");
    $pass2=filter_input(INPUT_GET, "password2");
    
    $error_cursor = -1;

    if (empty($email)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 0;
    }
    else if (empty($uname)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 1;
    }
    else if (empty($fname)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 2;
    }
    else if (empty($lname)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 3;
    }
    else if (empty($pass1)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 4;
    }
    else if (empty($pass2)) {
        $error_message.=addErrorText('Fields may not be empty.');
        $error_cursor = 5;
    }

    if ((!empty($pass1) && !empty($pass2)) && $pass1 != $pass2) {
        $error_message.=addErrorText('Passwords must match.');
        $error_cursor = 4;
    }

    if (check_existing("CustEmail", $email)) {
        $error_message.=addErrorText('There is already an account with this email address.');
        $error_cursor = 0;
    }

    
    if (check_existing("CustUserName", $uname)) {
        $error_message.=addErrorText('This username is already taken.');
        if ($error_cursor >= 1)
            $error_cursor = 1;
    }

    if ($error_cursor == -1) {
        $pass = password_hash($pass1, PASSWORD_DEFAULT);
        $status = create_cust($email, $uname, $pass, $fname, $lname);
        if ($status == true) {
            header('Location: .?action=login&username='.$uname.'&password='.$pass1);
        }
    }
    else {
        include('../View/signup.php');
    }
}
else if ($action == "logout") {
    setcookie("id", "", time()-3600, "/");
    setcookie("username", "", time()-3600, "/");
    setcookie("password", "", time()-3600, "/");

    header('Location: .?action=login_page');
}
?>