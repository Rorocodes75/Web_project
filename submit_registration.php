<?php

$con = new mysqli('localhost', 'root', '', 'hospital_DB');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name1 = $con->real_escape_string($_POST['name']);
    $email1 = $con->real_escape_string($_POST['email']);
    $username1 = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    $q = "INSERT INTO user (name, email, username, password) VALUES ('$name1', '$email1', '$username1', '$password')";

    if ($con->query($q) === TRUE) {
        header('Location: login.html');
    } else {
        echo "<p>Error inserting record: " . $con->error . "</p>";  
    }
}

$con->close();
?>
