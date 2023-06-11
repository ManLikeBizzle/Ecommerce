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
    <title>Ecommerce - Basket</title>
</head>
<body>
    <div class="nav">
        <div class="back">
            <a href="index.php">Ecommerce</a>
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

    <div class="basket-content">
    <?php
// Check if the item ID is submitted via the form
if (isset($_POST['add_to_cart'])) {
    // Get the item ID from the form data
    $item_id = $_POST['item_id'];

    // Add the item to the basket session variable
    $_SESSION['basket'][$item_id] = true;

    // Redirect the user back to the index page
    header("Location: index.php");
    exit();
}

// Check if the item ID is submitted for removal
if (isset($_POST['remove_from_cart'])) {
    // Get the item ID from the form data
    $item_id = $_POST['item_id'];

    // Remove the item from the basket session variable
    if (isset($_SESSION['basket'][$item_id])) {
        unset($_SESSION['basket'][$item_id]);
    }

    // Redirect the user back to the basket page
    header("Location: basket.php");
    exit();
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
    <title>Ecommerce - Basket</title>
</head>
<body>
    <div class="basket-content">
        <?php
        // Check if the item is in the basket session variable
        if (isset($_SESSION["basket"]) && !empty($_SESSION["basket"])) {
            // Loop through the fetched results and generate HTML markup
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the item ID exists in the basket session variable
                if (isset($_SESSION["basket"][$row["item_id"]])) {
                    echo '<div class="basket-item-container">';
                    echo '<h3 class="item-name">' . $row["item_name"] . '</h3>';
                    echo '<p class="item-price">Price: £' . $row["item_price"] . '</p>';

                    // Container for the image
                    echo '<div class="basket-item-image-container">';
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['item_img']).'" class="item-image">';
                   

                    echo '</div>';

                    echo '<p class="item-desc">' . $row["item_desc"] . '</p>';

                    echo '<form action="basket.php" method="POST">';
                    echo '<input type="hidden" name="item_id" value="' . $row["item_id"] . '">';
                    echo '<button type="submit" class="remove-from-cart" name="remove_from_cart">Remove</button>';
                    echo '</form>';

                    echo '</div>';
                }
            }
            } else {
                echo '<p>Your basket is empty.</p>';
            }
        ?>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
