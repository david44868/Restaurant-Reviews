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
    <title>FoodGuide :: Sign Up</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="header-container">
            <div id="logo">
                <?php 
                    if(!isset($_SESSION['auth']))
                    {
                        echo '<h1>
                            <a href="index.html">FoodGuide</a>
                            </h1>';
                    }
                    else
                    {
                        echo '<h1>
                            <a href="welcome.php">FoodGuide</a>
                            </h1>';
                    }
                ?>
                <img src="utensil.png" height=150px width=150px/>
            </div>
            <nav>
                <?php 
                    if(!isset($_SESSION['auth']))
                    {
                        echo '<a href="login.html" class = "box">Log In</a>&nbsp&nbsp
                            <a href="signup.html" class = "box">Sign Up</a>';
                    }
                    else
                    {
                        echo '<a href="account.php" class = "box" >My Account</a>&nbsp&nbsp
                            <a href="logout.php" class = "box">Log Out</a>';
                    }
                ?>
            </nav>
        </div>
    </header>
    <?php 
        $restaurant = $_GET['restaurant'];
        $restaurantId = $_GET['id'];
        echo "<h2>Creating a Review for $restaurant</h2>"
    ?>
    <form method="POST" action="send_review.php">
        <div class="info">
            <label for="quantity">Enter your rating from 1 (worse) to 5 (best):</label>
            <input type="hidden" value="<?php echo $restaurantId?>" name="restaurant" id="restaurant">
            <input type="number" required min="1" max="5" id="quantity" name="quantity">
            <textarea id="review" name="review" placeholder="Enter your review..."></textarea>
            <input type="submit" value="Submit Review">
        </div>
    </form>
</body>