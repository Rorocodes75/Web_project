<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "hospital_DB";  

$conn = new mysqli($servername, $db_username, $db_password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; 

    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header('Location: homepage.html');
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
