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
    <title>FoodGuide :: My Account</title>
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
                <?php 
                    if($_SESSION['role'] == 1)
                    {
                        echo "<a href='manage_users.php' class = 'box'>Manage Users</a>";
                    }
                ?>
                <a href="logout.php" class = "box">Log Out</a>
            </nav>
        </div>    
    </header>
    <h2>Edit Profile Information</h2>
    <form method="POST" action="edit_info.php">
        <div class="info">
            <label for="firstName">First name:</label>
            <input type="text" placeholder=<?php echo $_SESSION['first_name'];?> name="firstName" id="firstName">
            <label for="lastName">Last name:</label>
            <input type="text" placeholder=<?php echo $_SESSION['last_name'];?> name="lastName" id="lastName">
            <label for="email">Email:</label>
            <input type="email" placeholder=<?php echo $_SESSION['email'];?> name="email" id="email">
            <div>
                <input type="submit" class="save" value="Save changes">
                <input type="button" class="save" onclick="location.href='change_password.php'" value="Change password">
            </div>
        </div>   
    </form>
</body>