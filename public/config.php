<?php
    $host="127.0.0.1";
    $port=3306;
    $user="root";
    $password="";
    $dbname="restaurant_db";

    $conn = mysqli_connect($host, $user, $password, $dbname, $port);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
?>