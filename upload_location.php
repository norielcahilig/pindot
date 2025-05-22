<?php
$lat = $_POST['latitude'];
$lon = $_POST['longitude'];
$user = $_POST['user'];
$accuracy = $_POST['accuracy'];

$conn = new mysqli("mysql.railway.internal", "root", "IxCCroSfWKaBIInDuRIzxnpLReHUxhbY", "railway");

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
