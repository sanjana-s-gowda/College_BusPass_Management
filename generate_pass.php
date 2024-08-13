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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylespass.css">
    <title>Bus Pass</title>
</head>
<body>
    <div class="bus-pass">
        <h1>Bus Pass</h1>
        <?php if ($profile): ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
            <p><strong>USN:</strong> <?php echo htmlspecialchars($profile['usn']); ?></p>
            <p><strong>Semester:</strong> <?php echo htmlspecialchars($profile['sem']); ?></p>
            <p><strong>Branch:</strong> <?php echo htmlspecialchars($profile['branch']); ?></p>
            <p><strong>Stop Name:</strong> <?php echo htmlspecialchars($profile['stop_name']); ?></p>
            <p><strong>Route Number:</strong> <?php echo htmlspecialchars($profile['route_number']); ?></p>
            <p><strong>Receipt Number:</strong> <?php echo htmlspecialchars($profile['receipt_number']); ?></p>
            <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($profile['mobile_number']); ?></p>
        <?php else: ?>
            <p>No profile found. Please create a profile first.</p>
        <?php endif; ?>
        <a href="dashboard.php?username=<?php echo $user; ?>" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>