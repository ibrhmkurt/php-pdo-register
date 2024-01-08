<?php
require("config.php");
require("functions.php");

    if(@$_POST) {
        $fullname = security($_POST["fullname"]);
        $username = security($_POST["username"]);
        $email = security($_POST["email"]);
        $pass_one = security($_POST["pass-one"]);
        $pass_two = security($_POST["pass-two"]);

        if((!$fullname) or (!$username) or (!$email) or (!$pass_one) or (!$pass_two)) {
            echo "Please fill in all fields.";
            die();
        }
        else {
            if($pass_one != $pass_two) {
                echo "Passwords do not match.";
                die();
            }
            else {
                $pass_one = md5($pass_one);
                $pass_two = md5($pass_two);
                $query = $db->prepare("SELECT * FROM users WHERE user_username = ?");
                $query->execute(array($username));
                $num = $query->rowCount();
                if($num != 0) {
                    echo "Username already exists.";
                    die();
                }
                else {
                    $query = $db->prepare("INSERT INTO users SET user_fullname = ?, user_username = ?, user_email = ?, user_password = ?");
                    $insert = $query->execute(array($fullname, $username, $email, $pass_one));
                    if($insert) {
                        echo "Registration successful.";
                        die();
                    }
                    else {
                        echo "Registration failed.";
                        die();
                    }
                }
            }
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Register</title>
</head>
<body>

    <br>
    <h1>PDO Register</h1>
    <br>

    <form action="" method="post">
        
        <table>
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="fullname" placeholder="Enter Full Name"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" placeholder="Enter Username"></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><input type="email" name="email" placeholder="Enter E-mail"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="pass-one" placeholder="Enter Password"></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="pass-two" placeholder="Enter Confirm Password"></td>
            </tr>
        </table>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>