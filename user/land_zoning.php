<?php 
include('../user/assets/config/dbconn.php');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php');
    ?>
    <title>Interactive Zoning Map</title>
    
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="main.css">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <!-- JavaScript files -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="js/map.js" defer></script>
</head>
    
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    
 
  <body class="vertical  light">
    <div class="wrapper">
    <div class="wrapper">


    <?php include('../user/inc/navbar.php');
        ?>
    <?php include('../user/inc/sidebar.php');
        ?>

      <main role="main" class="main-content">

<!--For Notification header naman ito-->
        <?php include('../user/inc/notif.php'); 
        ?>

<!--YOUR CONTENT HERE-->
<h1>Interactive Zoning Map</h1>
    
    <!-- Map Container -->
    <div id="map"></div>

    <script>
        // Pass PHP data to JavaScript using inline script
        var zoningData = <?php echo $zoningData; ?>;

        // Initialize the map
        var map = L.map('map').setView([14.7250, 121.0326], 15);  // Coordinates for your data location (adjust if needed)

        // Tile Layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Load zoning data from the PHP variable (converted to JSON)
        L.geoJSON(zoningData, {
            style: function (feature) {
                return {
                    color: feature.properties.fill || "#3388ff",  // Default color if "fill" property is empty
                    weight: 2,
                    opacity: 0.7,
                    fillOpacity: 0.5
                };
            },
            onEachFeature: function (feature, layer) {
                if (feature.properties.Note) {
                    layer.bindPopup("<strong>Note:</strong> " + feature.properties.Note);
                }
            }
        }).addTo(map);
    </script>


    
    <!-- Include jQuery (once) -->
    <?php 
include('../user/inc/footer.php');
?> 
</body>
</html>