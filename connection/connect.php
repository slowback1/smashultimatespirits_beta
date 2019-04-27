<?php
/* This connects to a DB that will have a bunch of junk data in it */
    $servername = "remotemysql.com";
    $username = "y78t7xE7Ii";
    $password = "qpDswn1oKc";
    $dbname = "y78t7xE7Ii";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
?>