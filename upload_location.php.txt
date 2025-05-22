<?php
$lat = $_POST['latitude'];
$lon = $_POST['longitude'];
$user = $_POST['user'];
$accuracy = $_POST['accuracy'];

$conn = new mysqli("your_mysql_host", "your_mysql_user", "your_mysql_password", "your_mysql_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO locations (user, latitude, longitude, accuracy) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sddd", $user, $lat, $lon, $accuracy);
$stmt->execute();
$stmt->close();
$conn->close();

echo "Location saved.";
?>
