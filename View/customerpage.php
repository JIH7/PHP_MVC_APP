<?php
$cookie_name="id";
if (!isset($_COOKIE[$cookie_name])) {
    include('../View/login.php');
    exit();
}

$cust = retrieve_cust($_COOKIE[$cookie_name]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Login!</title>
    
    <link rel="stylesheet" type="text/css" href="../View/style.css">
    <link rel="stylesheet" type="text/css" href="../View/customerpage.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- /Fonts -->

    <script src="../View/customerpage.js"></script>
</head>
<body>
    <header>
        <h1>Congratulations!</h1>
        <h2>You've successfully logged in.</h2>
    </header>
    <main class="card info">
        <h3>Welcome <?php echo $cust[3] ?>!</h3>
        <p>ID cookie: <?php echo $_COOKIE["id"] ?></p>
        <p>Username cookie: <?php echo $_COOKIE["username"] ?></p>
        <p>Password cookie (first few digits of hashed password): <?php echo $_COOKIE["password"] ?></p>
        <form id="logout" method="get" action=".">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Log out">
        </form>
    </main>
</body>
</html>