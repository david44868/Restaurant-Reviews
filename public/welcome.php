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
    <title>FoodGuide</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
            <div>
                <a href="account.php" class = "box" >My Account</a>&nbsp&nbsp
                <a href="logout.php" class = "box">Log Out</a>
            </div>
        </div>   
    </header>
    <h2>Welcome back, <?php echo $_SESSION['first_name']; ?></h1>
    <form method="get" action="search.php"> 
        <div id="search">
            <input type="search" class="query" id="query" name="query" placeholder="Search for the food you love..." required>
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>  
    </form>
    <div class="parent">
        <div class="slogan">Your Guide To Good Food</div>
    </div>
    <footer>
        <p>
            Copyright © 2022 FoodGuide <br>
            David Harianto
        </p>
    </footer>
</body>