<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

session_start();

// Database connection details
$servername = "localhost";
$username = "root";  // Adjust this based on your MySQL username
$password = "";  // Default MySQL password is often empty for root on local servers
$dbname = "hospital_DB";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name1 = $conn->real_escape_string($_POST['name']);
    $email1 = $conn->real_escape_string($_POST['email']);
    $username1 = $conn->real_escape_string($_POST['username']);
    $password1 = $conn->real_escape_string($_POST['password']);

    // Insert the user data into the database
    $sql = "INSERT INTO user (name, email, username, password) VALUES ('$name1', '$email1', '$username1', '$password1')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registered successfully!'); window.location.href = 'login.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();

$conn->close();
?>
