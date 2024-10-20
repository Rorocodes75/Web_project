<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process feedback form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name1 = $conn->real_escape_string($_POST['name']);
    $email1 = $conn->real_escape_string($_POST['email']);
    $username1 = $conn->real_escape_string($_POST['username']);
    $password1= $conn->real_escape_string($_POST['password']);

    $sql = "INSERT INTO user (name,email,username,password) VALUES ('$name1', '$email1','$username1','$password1')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('registerd submitted successfully!'); window.location.href = 'login.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>