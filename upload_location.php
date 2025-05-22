<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get POST data safely (add validation if needed)
$lat = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
$lon = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;
$user = isset($_POST['user']) ? $_POST['user'] : null;
$accuracy = isset($_POST['accuracy']) ? floatval($_POST['accuracy']) : null;

if ($lat === null || $lon === null || $user === null || $accuracy === null) {
    http_response_code(400);
    echo "Missing required parameters.";
    exit;
}

// Database connection settings — replace with your actual credentials
$dbhost = "localhost";       // or your host, e.g. sql108.infinityfree.com
$dbuser = "your_db_user";
$dbpass = "your_db_pass";
$dbname = "your_db_name";

// Connect to DB
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute insert statement securely
$stmt = $conn->prepare("INSERT INTO locations (user, latitude, longitude, accuracy) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sddd", $user, $lat, $lon, $accuracy);

if ($stmt->execute()) {
    echo "Location saved.";
} else {
    http_response_code(500);
    echo "Failed to save location.";
}

$stmt->close();
$conn->close();
?>
