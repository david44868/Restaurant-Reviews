<?php
    require_once "config.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email_address = '$email' and password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = $result -> fetch_assoc();
    
    if(mysqli_num_rows($result) == 1)
    {
        session_start();
        $_SESSION['auth']='true';
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['user_id'];
        $_SESSION['first_name']=$row['first_name'];
        $_SESSION['last_name']=$row['last_name'];
        $_SESSION['password']=$row['password'];
        $_SESSION['role']=$row['role'];
        
        mysqli_close($conn); 
        
        echo 
        "<script>
        alert('Log in successful.');
        window.location.href='welcome.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Email or password is incorrect!');
        window.location.href='login.html';
        </script>";
    }

?>