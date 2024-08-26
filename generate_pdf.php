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

if ($profile) {
    // Create a string representation of the bus pass in HTML format
    $busPassContent = "
    <html>
    <head><title>Bus Pass</title></head>
    <body>
    <h1>Bus Pass</h1>
    <p><strong>Name:</strong> {$profile['name']}</p>
    <p><strong>USN:</strong> {$profile['usn']}</p>
    <p><strong>Semester:</strong> {$profile['sem']}</p>
    <p><strong>Branch:</strong> {$profile['branch']}</p>
    <p><strong>Stop Name:</strong> {$profile['stop_name']}</p>
    <p><strong>Route Number:</strong> {$profile['route_number']}</p>
    <p><strong>Receipt Number:</strong> {$profile['receipt_number']}</p>
    <p><strong>Mobile Number:</strong> {$profile['mobile_number']}</p>
    </body>
    </html>";

    // Set the headers to force download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="bus_pass_'.$profile['username'].'.html"');
    header('Content-Length: ' . strlen($busPassContent));

    // Output the content
    echo $busPassContent;
} else {
    echo "No profile found.";
}
?>
