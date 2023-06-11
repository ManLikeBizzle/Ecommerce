<?php
session_start();

if (isset($_POST['remove_from_cart'])) {
  // Get the item ID from the form data
  $item_id = $_POST['item_id'];

  // Remove the item from the basket (you should implement your own logic here)
  // For example, if you store the basket items in the session, you can remove it like this:
  if (isset($_SESSION['basket'][$item_id])) {
    unset($_SESSION['basket'][$item_id]);
  }
}

// Redirect back to the basket page
header("Location: basket.php");
exit();
?>
