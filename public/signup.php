<?php
    include("config.php");

    // get the post records
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check if email is already registered 
    $select = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '$email'");
    if(mysqli_num_rows($select)) {
        echo "<script type='text/javascript'>alert('Email has already been used.');location='signup.html';</script>";
        exit();
    }

    // database insert SQL code
    $sql = "INSERT INTO users (first_name, last_name, email_address, password, role) 
            VALUES ('$firstName', '$lastName', '$email', '$password', '2')";

    // insert in database 
    $rs = mysqli_query($conn, $sql);

    //connection closed.
    mysqli_close($conn); 
    
    // new user account message
    $message = "Account successfully created. Log in with your email and password.";
    echo "<script type='text/javascript'>alert('$message');location='login.html';</script>";

?>