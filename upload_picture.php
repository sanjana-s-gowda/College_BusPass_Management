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

if (isset($_POST['username']) && isset($_FILES['profile_picture'])) {
    $user = htmlspecialchars($_POST['username']);
    
    // Handle file upload
    $profile_picture = '';
    if ($_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Create the uploads directory if it doesn't exist
        }
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = htmlspecialchars(basename($_FILES["profile_picture"]["name"]));
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Update the database with the new profile picture
    $sql = "UPDATE profiles SET profile_picture = '$profile_picture' WHERE username = '$user'";
    if ($conn->query($sql) === TRUE) {
        header("Location: generate_pass.php?username=$user");
        exit;
    } else {
        echo "Error updating profile picture: " . $conn->error;
    }
}

$conn->close();
?>
