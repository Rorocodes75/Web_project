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
    $rating1 = $_POST['rating'];
    $comments1= $conn->real_escape_string($_POST['comments']);

    $sql = "INSERT INTO feedback (rating, comments) VALUES ('$rating1', '$comments1')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback submitted successfully!'); window.location.href = 'feedback.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$sqlselect = "SELECT rating, comments FROM feedback";
$result = $conn->query($sqlselect);

if (!$result) {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Hospital Home Page</title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="43200">
</head>
<body>
    <div class="homepage">
        <header class="header">
            <img class="logo" src="logo.png"/>
            <nav class="navbar">
              <div class="dropdown">
                <img class="dropbtn" src="menu.png"/>
                <div class="dropdown-content">
                  <a href="homepage.html">Home</a>
                  <a href="Departments.html">Departments</a>
                  <a href="doctors.html">Doctors</a>
                  <a href="gallery.html">Gallery</a>
                  <a href="patint-visitior.html">Patiants / Visitors</a>
                  <a href="contact-us.html"> Contact us </a>
                  <a href="aboutus.html"> About us </a>
                </div>
              </div> 
            </nav>
            <div class="contact-info">
                <div class="email"><a href="mailto:hospital@gmail.com">Email: hospital@gmail.com</a></div>
                <div class="telephone"><a href="tel:0552345649">Telephone: 055-234-5649</a></div>
            </div>
            <div class="social-media">
                <a href="https://instagram.com">
                    <img class="social-icon" src="instagram.png" />
                </a>
                <a href="https://x.com">
                    <img class="social-icon" src="x.png" />
                </a>
            </div>
            
        </header>
<body>
    <a class="book-appointment-button" href="login.html">Book appointment
        <img class="icon" src="calendar.png" /></a>

    <section class="images">
        <div class="background">
            <img class="background-fback" src="background img color.png" />
    <div class="feedback-container">
        <h2>Give us a rating! from 0 to 10, where 0 is horrible and 10 is Amazing!</h2>
        <form action="feedback.php" method="POST">
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="0" max="10" placeholder="your rating" required>
            
            <h3>Do you have any thoughts you would like to share?</h3>
            <textarea id="comments" name="comments" placeholder="I do have feedback! "></textarea>
            
            <div class="button-container">
                <button class="feedback-SR" type="submit">Ok</button>
                <button class="feedback-SR" type="reset">Clear</button>
            </div>
        </form>

    </div>
    <h2 >Previous Feedback</h2>
    <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="feedback-entry">
            <strong>Rating: <?php echo htmlspecialchars($row['rating']); ?></strong>
            <p><?php echo htmlspecialchars($row['comments']); ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No feedback available.</p>
<?php endif; ?>
</body>
</html>
    <footer class="footer">
        <p>&copy 2024-25 / IMSIU / CCIS &trade;</p>
    </footer>
</div>
</body>
</html>
<?php
$conn->close();
?>