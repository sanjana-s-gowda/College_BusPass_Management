<?php
if (!isset($_GET['username'])) {
    header("Location: login.html");
    exit;
}
?>

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
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h1>Welcome, <?php echo $user; ?>!</h1>
            
            <?php if ($profile): ?>
                <h2>Your Profile</h2>
                <p>Name: <?php echo htmlspecialchars($profile['name']); ?></p>
                <p>USN: <?php echo htmlspecialchars($profile['usn']); ?></p>
                <p>Semester: <?php echo htmlspecialchars($profile['sem']); ?></p>
                <p>Branch: <?php echo htmlspecialchars($profile['branch']); ?></p>
                <p>Stop Name: <?php echo htmlspecialchars($profile['stop_name']); ?></p>
                <p>Route Number: <?php echo htmlspecialchars($profile['route_number']); ?></p>
                <p>Receipt Number: <?php echo htmlspecialchars($profile['receipt_number']); ?></p>
                <p>Mobile Number: <?php echo htmlspecialchars($profile['mobile_number']); ?></p>
                <a href="edit_profile.php?username=<?php echo $user; ?>" class="btn">Edit Profile</a>
            <?php else: ?>
                <h2>Create Your Profile</h2>
                <form action="profile_process.php" method="post">
                    <input type="hidden" name="username" value="<?php echo $user; ?>">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="usn">USN:</label>
                    <input type="text" id="usn" name="usn" required>

                    <label for="sem">Semester:</label>
                    <input type="text" id="sem" name="sem" required>

                    <label for="branch">Branch:</label>
                    <input type="text" id="branch" name="branch" required>

                    <label for="stop_name">Stop Name:</label>
                    <input type="text" id="stop_name" name="stop_name" required>

                    <label for="route_number">Route Number:</label>
                    <input type="text" id="route_number" name="route_number" required>

                    <label for="receipt_number">Receipt Number:</label>
                    <input type="text" id="receipt_number" name="receipt_number" required>

                    <label for="mobile_number">Mobile Number:</label>
                    <input type="text" id="mobile_number" name="mobile_number" required>

                    <input type="submit" value="Save Profile" class="btn">
					
					<label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

					
                </form>
            <?php endif; ?>

            <!-- Add Next button -->
            <a href="next_page.php?username=<?php echo $user; ?>" class="btn">Next</a>
			<a href="generate_pass.php?username=<?php echo $user; ?>" class="btn">Generate Bus Pass</a>

        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>