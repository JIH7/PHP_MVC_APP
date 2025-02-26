<?php
$dsn=getenv("DSN");
$username=getenv("MYSQL_USERNAME");
$password=getenv("MYSQL_PASSWORD");

try {
    $db = new PDO($dsn, $username, $password);
}
catch(PDOException $e) {
    $error_message = $e->getMessage();
    include('database_error.php');
    exit();
}
?>