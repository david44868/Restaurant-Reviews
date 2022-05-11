<?php 
    session_start();
    if(!$_SESSION['auth'])
    {
        header('location:login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>FoodGuide :: Password Change</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="header-container">
            <div id="logo">
                <h1>
                    <a href="welcome.php">FoodGuide</a>
                </h1>
                <img src="utensil.png" height=150px width=150px/>
            </div>
            <nav>
                <a href="logout.php" class = "box">Log Out</a>
            </nav>
        </div>    
    </header>
    <h2>Change Password</h2>
    <form method="POST" action="edit_pass.php">
        <div class="info">
            <input type="password" placeholder="Old Password.." minlength = "8" name="old_password">
            <input type="password" placeholder="New Password.." minlength = "8" name="new_password">
            <input type="submit" class="save" value="Save changes">
        </div>   
    </form>
</body>