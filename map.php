<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Replace with your actual database credentials
$conn = new mysqli("localhost", "your_db_user", "your_db_pass", "your_db_name");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT latitude, longitude FROM locations ORDER BY timestamp DESC LIMIT 1");

if ($result && $row = $result->fetch_assoc()) {
    $lat = $row['latitude'];
    $lon = $row['longitude'];
} else {
    // Default fallback coordinates (e.g., Manila) in case no data
    $lat = 14.5995;
    $lon = 120.9842;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>PINdot Map</title>
  <style>
    #map { height: 100vh; width: 100vw; margin: 0; }
    body { margin: 0; }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([<?= $lat ?>, <?= $lon ?>], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([<?= $lat ?>, <?= $lon ?>]).addTo(map)
      .bindPopup("Latest Device Location").openPopup();
  </script>
</body>
</html>
