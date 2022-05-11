<?php 
    session_start();
    if(!$_SESSION['auth'])
    {
        header('location:login.html');
    }

    $email = $_POST['email'];

    include("config.php");

    $sql = mysqli_query($conn, "DELETE FROM users WHERE email_address = '$email'");
    
    mysqli_close($conn); 
    
    echo 
    "<script>
    alert('User account has been deleted.');
    window.location.href='manage_users.php';
    </script>";
?>
