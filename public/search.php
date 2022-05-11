<?php 
    session_start();
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
            <form method='get' action="search.php"> 
                <div id="top">
                    <input type="search" class="query" id="query" name="query" placeholder="<?php echo $_GET['query']?>" required>
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>  
            </form>
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
        require_once "config.php";
        $search = $_GET['query'];
        $search = str_replace("'", "\\'", $search);

        $query = "SELECT * FROM restaurants WHERE restaurant_name LIKE '%$search%' 
                OR food_type LIKE '%$search%' or REPLACE(restaurant_name, '-', '') LIKE '%$search%'
                or REPLACE(restaurant_name, '\'', '') LIKE '%$search%'";
        $result = mysqli_query($conn, $query);
        
        if($result !== false && $result->num_rows > 0)
        {
            $count = 1;
            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                echo "<div class='results'>";
                $restaurant = $row['restaurant_name'];
                $restaurantId = $row['restaurant_id'];
                $rating = $row['average_rating'];
                $logo = $row['logo'];
                if($logo == null)
                {
                    echo "<img src='no_image.jpg' height=100px width=100px align=left/>";
                }
                else
                {
                    echo "<img src='$logo' height=100px width=100px align=left/>";
                }
                echo "<div>";
                echo "<h4>";
                echo $count.". "."<a href='display.php?restaurantId=$restaurantId' class='search'>$restaurant</a>";
                echo "</h4>";
                echo "<h5>";
                echo $row['food_type'];
                echo "<h5>";
                echo "<br/>";
                echo "<h4>";
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
                echo "<h4>";
                echo "</div>";
                echo "</div>";
                
                $count++;
            }
        }
        else {
            echo "<h2>No results for \"$search\"</h2>";
            echo "<h3>Suggestions for improving your results:</h3>";
            echo 
            "<ul>
                <li>Check the spelling or try alternate spellings</li>
                <li>Try entering the restaurant name</li>
                <li>Try entering a general type of restaurants, e.g. 'Fast food' or 'Chinese'</li>
                <li>Check for missing spaces</li>
            </ul>";
        }
                            
        mysqli_close($conn);  //Make sure to close out the database connection
    ?>
</body>