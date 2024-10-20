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

if (isset($_GET['doctor_name'])) {
    $doctor_name = $conn->real_escape_string($_GET['doctor_name']);

    $sql = "SELECT * FROM doctors WHERE name LIKE '%$doctor_name%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

    <div class="results-container">
        <h2>Search Results for "<?php echo htmlspecialchars($doctor_name); ?>"</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['dep']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No results found for "<?php echo htmlspecialchars($doctor_name); ?>"</p>
        <?php endif; ?>

        <a href="Doctors.html" class="back-btn">Back to Search</a>
    </div>
    <footer class="footer">
    <p>&copy 2024-25 / IMSIU / CCIS &trade;</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>
