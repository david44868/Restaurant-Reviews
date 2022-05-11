<?php 
    session_start();
    if(!$_SESSION['auth'])
    {
        header('location:login.html');
    }
    include("config.php");
    $rating = $_POST['quantity'];
    $review = $_POST['review'];
    $restaurantId = $_POST['restaurant'];
    $user = $_SESSION['id'];

    $sql = "INSERT INTO reviews (restaurant_id, user_id, description, rating) 
            VALUES ('$restaurantId', '$user', '$review', '$rating')";

    $query = mysqli_query($conn, $sql);

    $select = mysqli_query($conn, "SELECT * FROM reviews WHERE restaurant_id = '$restaurantId'");
    $sum = 0;
    $count = 0;
    while($row = mysqli_fetch_array($select))
    {
        $sum += $row['rating'];
        $count++;
    }
    $average = $sum / $count;
    $setRating = mysqli_query($conn, "UPDATE restaurants SET average_rating = '$average' WHERE restaurant_id = '$restaurantId'");
    

    mysqli_close($conn); 

    $message = "Review successfully created.";
    echo "<script type='text/javascript'>alert('$message');location='display.php?restaurantId=$restaurantId';</script>";
?>
