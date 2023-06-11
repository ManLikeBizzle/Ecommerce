<?php
    $host = "localhost";
    $username = "root"; 
    $password = "Bennellmurray1"; 
    $database = "accounts"; 

    // Create a connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Connection successful
    echo "Connected to the database successfully!";
?>