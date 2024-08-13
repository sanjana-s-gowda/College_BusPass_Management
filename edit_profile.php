<?php
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "bus_pass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = htmlspecialchars($_GET['username']);
$sql = "SELECT * FROM profiles WHERE username = '$user'";
$result = $conn->query($sql);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Edit Your Profile</h1>
            <form action="update_profile.php" method="post">
                <input type="hidden" name="username" value="<?php echo $user; ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($profile['name']); ?>" required>

                <label for="usn">USN:</label>
                <input type="text" id="usn" name="usn" value="<?php echo htmlspecialchars($profile['usn']); ?>" required>

                <label for="sem">Semester:</label>
                <input type="text" id="sem" name="sem" value="<?php echo htmlspecialchars($profile['sem']); ?>" required>

                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="branch" value="<?php echo htmlspecialchars($profile['branch']); ?>" required>

                <label for="stop_name">Stop Name:</label>
                <input type="text" id="stop_name" name="stop_name" value="<?php echo htmlspecialchars($profile['stop_name']); ?>" required>

                <label for="route_number">Route Number:</label>
                <input type="text" id="route_number" name="route_number" value="<?php echo htmlspecialchars($profile['route_number']); ?>" required>

                <label for="receipt_number">Receipt Number:</label>
                <input type="text" id="receipt_number" name="receipt_number" value="<?php echo htmlspecialchars($profile['receipt_number']); ?>" required>

                <label for="mobile_number">Mobile Number:</label>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($profile['mobile_number']); ?>" required>

                <input type="submit" value="Save Profile" class="btn">
				<!-- Add Next button here -->
                <a href="next_page.php?username=<?php echo $user; ?>" class="btn">Next</a>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
