<?php

// Database connection
$con = new mysqli('localhost', 'root', '', 'hospital_DB');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
// Process form submission if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name1 = $con->real_escape_string($_POST['name']);
    $email1 = $con->real_escape_string($_POST['email']);
    $username1 = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    // Insert query
    $q = "INSERT INTO user (name, email, username, password) VALUES ('$name1', '$email1', '$username1', '$password')";

    // Execute query and check if successful
    if ($con->query($q) === TRUE) {
        header('Location: login.html');
    } else {
        echo "<p>Error inserting record: " . $con->error . "</p>";  // Print the SQL error for debugging
    }
}

// Close the connection
$con->close();
?>
