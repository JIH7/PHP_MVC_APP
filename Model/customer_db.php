<?php
    function login_cust($u, $p) {
        global $db;

        $query='SELECT CustID, CustUserName, CustPassword FROM Customers
        WHERE CustUserName = :username';
        $statement=$db->prepare($query);
        $statement->bindValue(':username', $u);
        $statement->execute();
        $cust=$statement->fetch();
        $statement->closeCursor();

        $verified = password_verify($p, $cust[2]);

        if ($verified)
            return $cust;
        else
            return false;
    }

    function check_existing($field, $value) {
        global $db;
        $query='SELECT CustID, CustUserName, CustPassword FROM Customers
        WHERE '.$field.' = :val';
        $statement=$db->prepare($query);
        $statement->bindValue(':val', $value);
        $statement->execute();
        $cust=$statement->fetch();
        $statement->closeCursor();

        return (bool)$cust;
    }

    function create_cust($e, $u, $p, $fn, $ln) {
        global $db;
        $query='INSERT INTO Customers (CustUserName, CustPassword, CustEmail, CustFname, CustLname)
        VALUES (:username, :password, :email, :firstname, :lastname)';
        $statement=$db->prepare($query);
        $statement->bindValue(':username', $u);
        $statement->bindValue(':password', $p);
        $statement->bindValue(':email', $e);
        $statement->bindValue(':firstname', $fn);
        $statement->bindValue(':lastname', $ln);
        try {
            $statement->execute();
            return true;
        }
        catch (PDOException $e) {
            echo "Database error: The user could not be added. ".$e->message();
            return false;
        }
    }
?>