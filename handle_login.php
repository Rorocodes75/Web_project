<?php
session_start();

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "hospital_DB";  // your database name

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for login submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];  // Plain text password

    // Prepare and execute the query to check if the user exists in the database
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Check if the password matches (plain text comparison)
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect to homepage
            header('Location: homepage.html');
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password!'); window.history.back();</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
