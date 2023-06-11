<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    // Database connection details
    $host = "localhost"; // MySQL server host
    $username = "root"; // MySQL username
    $dbPassword = ""; // MySQL password
    $database = "accounts"; // MySQL database name
    $table = "createaccount"; // Table name for createaccount data

    // Create a connection
    $conn = mysqli_connect($host, $username, $dbPassword, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the user exists
    $sql = "SELECT * FROM $table WHERE email='$email' AND password='$userPassword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User exists
        $row = mysqli_fetch_assoc($result);
        $_SESSION["username"] = $row["username"]; // Store the username in a session variable
        mysqli_close($conn);
        header("Location: index.php");
        exit();
    }
    
    else {
        
    }
    $result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Database query error: " . mysqli_error($conn);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    // User exists
    // Rest of your code...
} else {
    echo "Invalid username or password";
}


    // Close the connection
    mysqli_close($conn);
}
?>
