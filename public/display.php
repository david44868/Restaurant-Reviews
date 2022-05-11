<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>FoodGuide</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div>
        <?php 
            $restaurantId = $_GET['restaurantId'];
            include("config.php");
            $select = mysqli_query($conn, "SELECT * FROM restaurants WHERE restaurant_id = '$restaurantId'");
            while($row = mysqli_fetch_array($select))
            {
                $restaurant = $row['restaurant_name'];
                $image = $row['image'];
                $rating = $row['average_rating'];
                $link = $row['website_link'];
                $address = $row['address'];
                $city = $row['city'];
                $state = $row['state'];
                $zipCode = $row['zip_code'];
                echo "<h2 id='content' >$restaurant</h2>";
                echo "<div class='restaurant'>";
                echo "<div class='col1'>";
                echo "<img src=$image height=200px width=300px />";
                
                if($row['website_link'] != null)
                {
                    echo "<h4>";
                    echo "&emsp;For more info: <br/>";
                    echo "</h4>";
                    echo "<h4>";
                    echo "&emsp;&emsp;<a href='$link' class='link'>Website Link</a>";
                    echo "</h4>";
                }
                else
                {
                    echo "<h4>";
                    echo "&emsp;For more info: <br/>";
                    echo "</h4>";
                    echo "<h4>";
                    echo "&emsp;&emsp;No website available.";
                    echo "</h4>";
                }

                echo "<h4>";
                echo "&emsp;Address: ";
                echo "</h4>";
                echo "<h5>";
                echo "&emsp;" . $address . "<br/>&emsp;" . $city . ", " . $state . " " . $zipCode;
                echo "</h5>";
                
                echo "</div>";
                
                echo "<div class='col2'>";
                echo "<h4>";
                echo $row['food_type']." restaurant";
                echo "</h4><br/>";

                echo "<p class='star'>";
                if($rating == null)
                {
                    for($i=1;$i<=5;$i++) {
                        echo '<span class="fa fa-star"></span>';
                    }
                    echo "&emsp;0 / 5";
                }
                else
                {
                    $floor = floor($rating);
                    for($i=1;$i<=$floor;$i++) {
                        echo '<span class="fa fa-star checked"></span>';
                    }
                    for($i=1;$i<=5-$floor;$i++) {
                        echo '<span class="fa fa-star"></span>';
                    }
                    echo "&emsp;";
                    echo round($rating, 2);
                    echo " / 5";
                }
                echo "</p>";

                echo "<div class='contain'>";
                echo "<h4>";
                echo "Reviews";
                if(isset($_SESSION['auth']))
                {
                    $userId = $_SESSION["id"];
                    $query = "SELECT * FROM reviews WHERE restaurant_id = '$restaurantId' AND user_id = '$userId'";
                    $result = mysqli_query($conn, $query);
                    $row = $result -> fetch_assoc();
                    if(mysqli_num_rows($result) >= 1)
                    {
                        echo "<h4>";
                        echo "<a href='#' class='link-right'>Already Reviewed</a>";
                        echo "</h4>";
                    }
                    else
                    {
                        echo "<h4>";
                        echo "<a href='add_review.php?id=$restaurantId&restaurant=$restaurant' class='link-right'>Add a review</a>";
                        echo "</h4>";
                    }
                }
                echo "</h4>";

                echo "</div>";

                $review = "SELECT * FROM reviews WHERE restaurant_id = '$restaurantId' ORDER BY review_id DESC LIMIT 2";
                $result = mysqli_query($conn, $review);
                while($row = mysqli_fetch_array($result))
                {
                    $userId = $row['user_id'];
                    $rating = $row['rating'];
                    $text = $row['description'];
                    echo "<div class='description'>";
                    $name = "SELECT * FROM users WHERE user_id = '$userId'";
                    $search = mysqli_query($conn, $name);
                    if($row2 = mysqli_fetch_array($search))
                    {
                        echo "<strong>" . $row2['first_name'] . " ". $row2['last_name'] . "</strong>" . "<br/>";
                    }
                    for($i=1;$i<=$rating;$i++) {
                        echo '<span class="fa fa-star checked"></span>';
                    }
                    for($i=1;$i<=5-$rating;$i++) {
                        echo '<span class="fa fa-star"></span>';
                    }
                    echo "<br/><em>" . $text . "</em>";
                    echo "</div>";
                }

                echo "</div>";
            }

            mysqli_close($conn);
            echo "</div>";
        ?>
    </div>
</body>