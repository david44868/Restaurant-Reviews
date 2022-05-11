<?php
    session_start();
    if(!$_SESSION['auth'])
    {
        header('location:login.html');
    }
    include("config.php");
    $id = $_SESSION['id'];

    if(empty($_POST['firstName']) &&  empty($_POST['lastName']) && empty($_POST['email']))
        header('location:account.php');
    if(!empty($_POST['firstName']))
    {
        $firstName = $_POST['firstName'];
        $sql = mysqli_query($conn, "UPDATE users SET first_name = '$firstName' WHERE user_id = '$id'");
        $_SESSION['first_name'] = $firstName;
    }
    if(!empty($_POST['lastName']))
    {
        $lastName = $_POST['lastName'];
        $select = mysqli_query($conn, "UPDATE users SET last_name = '$lastName' WHERE user_id = '$id'");
        $_SESSION['last_name'] = $lastName;
    }
    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];
        $select = mysqli_query($conn, "UPDATE users SET email = '$email' WHERE user_id = '$id'");
        $_SESSION['email'] = $email;
    }
    mysqli_close($conn); 
    
    echo 
    "<script>
    alert('Account successfully updated.');
    window.location.href='account.php';
    </script>";

?>