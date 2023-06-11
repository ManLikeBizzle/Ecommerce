<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $formUsername = $_POST["username"];
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    // Database connection details
    $host = "localhost"; // MySQL server host
    $dbUsername = "root"; // MySQL username
    $dbPassword = ""; // MySQL password
    $database = "accounts"; // MySQL database name
    $table = "createaccount"; // Table name for createaccount data

    // Create a connection
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the user exists
    $sql = "SELECT * FROM $table WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User already exists
        echo "User with this email already exists";
    } else {
        // User does not exist, proceed with account creation

        // Insert the user data into the database
        $sql = "INSERT INTO $table (email, password, username) VALUES ('$email', '$userPassword', '$formUsername')";
        $insertResult = mysqli_query($conn, $sql);

        if ($insertResult) {
            // Account created successfully
            $_SESSION["username"] = $formUsername; // Store the form username in a session variable
            mysqli_close($conn);
            header("Location: index.php");
            exit();
        } else {
            // Error occurred during account creation
            echo "Error creating account: " . mysqli_error($conn);
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>
