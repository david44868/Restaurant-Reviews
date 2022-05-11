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
    <h2>All Users</h2>

    <?php
    require_once "config.php";

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    echo "<table>";
    echo "<tr>";
    echo "<th>User Status</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Password</th>";
    echo "<th>DELETE</th>";
    echo "</tr>";

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $role = $row['role'];
        $first = $row['first_name'];
        $last = $row['last_name'];
        $email = $row['email_address'];
        $pass = "********";
        echo "<tr>";
        if($role == 1)
        {
            echo "<td>Admin</td>";
        }
        else
        {
            echo "<td>User</td>";
        }
        echo "<td>$first</td>";
        echo "<td>$last</td>";
        echo "<td>$email</td>";
        echo "<td>$pass</td>";
        echo "<td>";
        echo "<form method='post' action='delete_user.php'>";
        echo "<input type='hidden' name='email' value='$email'/>";
        echo "<input type='submit' id='delete' value='DELETE'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
        
    echo "</table>"; //Close the table in HTML
        
    mysqli_close($conn);  //Make sure to close out the database connection
    ?>
    
</body>