<?php
$lat = $_POST['latitude'];
$lon = $_POST['longitude'];
$user = $_POST['user'];
$accuracy = $_POST['accuracy'];

$conn = new mysqli("yamabiko.proxy.rlwy.net", "root", "kVmAdxNLIqNrheJTvXcZFBTvWddLnTYp", "railway", 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$stmt = $conn->prepare("INSERT INTO locations (user, latitude, longitude, accuracy) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sddd", $user, $lat, $lon, $accuracy);
$stmt->execute();
$stmt->close();
$conn->close();

echo "Location saved.";
?>
