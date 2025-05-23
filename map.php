<?php
$conn = new mysqli("yamabiko.proxy.rlwy.net", "root", "kVmAdxNLIqNrheJTvXcZFBTvWddLnTYp", "railway");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$result = $conn->query("SELECT latitude, longitude FROM locations ORDER BY timestamp DESC LIMIT 1");
$row = $result->fetch_assoc();
$lat = $row['latitude'];
$lon = $row['longitude'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>PINdot Map</title>
</head>
<body>
  <h1>Latest Location</h1>
  <p>Latitude: <?= $lat ?>, Longitude: <?= $lon ?></p>
  <img src="https://staticmap.openstreetmap.de/staticmap.php?center=<?= $lat ?>,<?= $lon ?>&zoom=17&size=600x400&markers=<?= $lat ?>,<?= $lon ?>,red" alt="Map">
</body>
</html>
