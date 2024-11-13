<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Factory</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/main.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <style>
        #map {
            height: 400px;
            margin-bottom: 20px;
        }

        #image-container {
            text-align: center;
            position: relative;
            width: 200px; /* Set the default width */
            transition: width 0.3s; /* Add smooth transition effect */
            margin: 0 auto; /* Center the container */
        }

        #image-container img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto; /* Center the image within the container */
            border-radius: 8px; /* Add border-radius for a rounded appearance */
        }

        #image-container:hover {
            width: 300px; /* Set the enlarged width on hover */
        }
    </style>
</head>
<body>
    <?php include "header.php";?>
    
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Address </h2>
                </div>
            </div>
        </div>
    </div>
    

    <br>
    
    <div align="middle" style="width:100%"> 
      <div style="width:90%;float:center;" id="map"></div>

     
    </div>
    
    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script>
    var map = L.map('map').setView([0, 0], 2); // Default view

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    map.locate({ setView: true, maxZoom: 16 });

    function onLocationFound(e) {
        var radius = e.accuracy / 2;
        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
        L.circle(e.latlng, radius).addTo(map);

        // Set destination coordinates
        var destination = L.latLng([31.537532, 35.104484]); // Updated coordinates

        // Set up routing control
        L.Routing.control({
            waypoints: [
                L.latLng(e.latlng.lat, e.latlng.lng),
                destination
            ],
            routeWhileDragging: true
        }).addTo(map);
    }

    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationerror', onLocationError);
</script>



</body>
</html>
