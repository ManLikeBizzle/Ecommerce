<?php
session_start();

// Database connection details
$host = "localhost"; // MySQL server host
$username = "root"; // MySQL username
$dbPassword = ""; // MySQL password
$database = "accounts"; // MySQL database name
$table = "item"; // Table name for item data

// Create a connection
$conn = mysqli_connect($host, $username, $dbPassword, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch items from the database
$sql = "SELECT * FROM $table";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Ecommerce</title>
</head>
<body>
    <div class="nav">
        <div class="title">
            <p>Ecommerce</p>
        </div>
        <div class="Login">
            <?php
            if (isset($_SESSION["username"])) {
                // User is signed in
                $username = $_SESSION["username"];
                $logoutUrl = "logout.php"; // The URL for the logout script
                echo '<a href="basket.php"><i class="fas fa-shopping-basket"></i></a>'; // Basket button with the Font Awesome basket icon

                echo '<a href="' . $logoutUrl . '?logout=true">' . $username . '</a>';
                
            } else {
                // User is not signed in
                echo '<a href="log-in.php">Sign In</a>';
            }
            ?>
        </div>
    </div>
    
    <div class="content">
    <div class="item-image-container">
    <?php
        // Loop through the fetched results and generate HTML markup
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="item">';
            echo '<h3 class="item-name">' . $row["item_name"] . '</h3>';
            echo '<p class="item-price">Price: £' . $row["item_price"] . '</p>';
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['item_img']).'" class="item-image">';
            echo '<p class="item-desc">' . $row["item_desc"] . '</p>';
            
            echo '<form action="basket.php" method="POST">';
                echo '<input type="hidden" name="item_id" value="' . $row["item_id"] . '">';
                echo '<button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>';
            echo '</form>';

            echo '</div>';
        }
        ?>
    </div>
</div>

</div>
    
</body>
</html>
