<?php
// Start a session if needed (for authentication or session-based features)
session_start();

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the form
if (isset($_GET['doctor_name'])) {
    $doctor_name = $conn->real_escape_string($_GET['doctor_name']);

    // Query to search for the doctor by name
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
        <!-- Your existing header and navbar code -->
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
        <!-- Your existing footer code -->
    </footer>
</body>
</html>

<?php
$conn->close();
?>
