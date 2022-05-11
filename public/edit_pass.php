<?php
    session_start();
    if(!$_SESSION['auth'])
    {
        header('location:login.html');
    }
    include("config.php");
    $id = $_SESSION['id'];

    if(empty($_POST['old_password']) || empty($_POST['new_password']))
        header('location:change_password.php');
    else
    {
        $old = $_POST['old_password'];
        $new = $_POST['new_password'];
        if($old == $_SESSION['password'])
        {
            $sql = mysqli_query($conn, "UPDATE users SET password = '$new' WHERE user_id = '$id'");
            $_SESSION['password'] = $new;
        }
        else
        {
            echo 
            "<script>
            alert('Old password was entered incorrectly.');
            window.location.href='edit_pass.php';
            </script>";
        }
        
    }
    mysqli_close($conn); 
    
    echo 
    "<script>
    alert('Password successfully updated.');
    window.location.href='edit_pass.php';
    </script>";

?>