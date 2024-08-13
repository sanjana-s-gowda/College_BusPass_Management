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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $usn = $_POST['usn'];
    $sem = $_POST['sem'];
    $branch = $_POST['branch'];
    $stop_name = $_POST['stop_name'];
    $route_number = $_POST['route_number'];
    $receipt_number = $_POST['receipt_number'];
    $mobile_number = $_POST['mobile_number'];

    $sql = "INSERT INTO profiles (username, name, usn, sem, branch, stop_name, route_number, receipt_number, mobile_number)
            VALUES ('$username', '$name', '$usn', '$sem', '$branch', '$stop_name', '$route_number', '$receipt_number', '$mobile_number')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?username=" . $username);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
