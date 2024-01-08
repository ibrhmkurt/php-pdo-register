<?php

    try{
        $host = "0.0.0.0:3306";
        $dbname = "pdo_register";
        $username = "root";
        $password = "1994420";
        $db = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", "$username", "$password");
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }

?>