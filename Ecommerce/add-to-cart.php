<?php
session_start();

// Check if the add_to_cart form is submitted
if (isset($_POST["add_to_cart"])) {
    $item_id = $_POST["item_id"];

    // Store the item ID in the cart session variable
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $_SESSION["cart"][$item_id] = true;

    // Redirect the user back to the index page or the basket page
    header("Location: index.php");
    exit();
} else {
    // Redirect the user back to the index page if the form is not submitted
    header("Location: index.php");
    exit();
}
?>
