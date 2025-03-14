<?php 
include('../user/assets/config/dbconn.php');

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php');
    ?>
    
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoning Map</title>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Zoning Map</h1>
    <div id="map"></div>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-choropleth@1.0.0/dist/leaflet-choropleth.js"></script>

    <script>
        // Initialize the map
        const map = L.map('map').setView([ 14.72979,121.03874 ], 12); // Default coordinates (e.g., San Francisco)

        // Set the tile layer (open street maps)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3707.9690249948676!2d121.03612297492653!3d14.72957538577215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0542d0ccaf1%3A0x54be2536d53a48e8!2sSan%20Agustin%20Barangay%20Hall!5e1!3m2!1sen!2sph!4v1741947883278!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade'
        }).addTo(map);

        // Add a GeoJSON layer (replace this with your own zoning data)
        const zoningData = {mapgeoJSON};

        // Style function for the zoning areas
        const style = (feature) => {
            return {
                fillColor: feature.properties.color, // Use color from the GeoJSON properties
                weight: 2,
                opacity: 1,
                color: 'black',
                dashArray: '3',
                fillOpacity: "#ff7afb"
            };
        };

        // Popup content function to display zoning info
        const onEachFeature = (feature, layer) => {
            if (feature.properties && feature.properties.name) {
                layer.bindPopup(`<h3>${feature.properties.name}</h3><p>${feature.properties.description || 'No description available.'}</p>`);
            }
        };

        // Add the GeoJSON layer to the map with styles and popups
        L.geoJSON(zoningData, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);

    </script>
    <!-- Include jQuery (once) -->
    <?php 
include('../user/inc/footer.php');
?> 
</body>
</html>