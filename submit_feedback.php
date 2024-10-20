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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $comments = $conn->real_escape_string($_POST['comments']);

    $sql = "INSERT INTO feedback (rating, comments) VALUES ('$rating', '$comments')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback submitted successfully!'); window.location.href = 'homepage.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
