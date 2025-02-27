<?php
    // Handle login
    function login_cust($u, $p) {
        global $db;
        // Select pased on provided username
        $query='SELECT CustID, CustUserName, CustPassword FROM Customers
        WHERE CustUserName = :username'; // Since passwords are hashed and usernames are unique, I query by username only
        $statement=$db->prepare($query);
        $statement->bindValue(':username', $u);
        $statement->execute();
        $cust=$statement->fetch();
        $statement->closeCursor();
        // Check hash against provided password
        $verified = password_verify($p, $cust[2]);

        if ($verified)
            return $cust;
        else
            return false;
    }
    // Check if a customer exists with the provided data ($value) in the provided column ($field)
    function check_existing($field, $value) {
        global $db;
        $query='SELECT CustID, CustUserName, CustPassword FROM Customers
        WHERE '.$field.' = :val'; // $field is concatonated rather than binded to avoid putting it in quotes
        $statement=$db->prepare($query);
        $statement->bindValue(':val', $value);
        $statement->execute();
        $cust=$statement->fetch();
        $statement->closeCursor();

        return (bool)$cust; // Just return if the row exists
    }
    // Insert a customer into DB. Used on the signup page
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
    // Uses the id cashed in a cookie to retrieve customer data which can be used to populate a page
    function retrieve_cust($id) {
        global $db;
        $query = "SELECT CustID, CustUserName, CustEmail, CustFname, CustLname
        FROM Customers
        WHERE CustID=:id";
        $statement=$db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $cust=$statement->fetch();
        $statement->closeCursor();
        return $cust;
    }
?>