<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Street Map</title>
    <link rel="icon" href="https://www.openstreetmap.org/assets/favicon-32x32-99b88fcadeef736889823c8a886b89d8cada9d4423a49a27de29bacc0a6bebd1.png">
</head>
<body>
    <div id="map" style="height: 100vh; width: 100%;"></div>

</body>
<script>
    // Set latitude and longitude
    const latLong = @json($latLong);

    if (latLong && latLong.length > 0) {
        const latitude = parseFloat(latLong[0]['latitude']); // Preserve decimal precision
        const longitude = parseFloat(latLong[0]['longitude']);
        console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

        // Initialize the map and set its view
        const map = L.map('map').setView([latitude, longitude], 18);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker (pin) at the specified location
        const marker = L.marker([latitude, longitude]).addTo(map);

        // Reverse geocoding using Nominatim API
        const geocodingUrl = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`;

        fetch(geocodingUrl)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the full response for debugging

                // Extract the street and barangay (if available)
                const address = data.address;
                const street = address.road || "Street not found";
                const barangay = address.suburb || address.village || "Barangay not found";

                // Update the marker popup with street and barangay
                marker.bindPopup(`<b>Pinned Location</b><br>
                                  Latitude: ${latitude}<br>
                                  Longitude: ${longitude}<br>
                                  <b>Street:</b> ${street}<br>
                                  <b>Barangay:</b> ${barangay}`).openPopup();
            })
            .catch(error => {
                console.error('Error with reverse geocoding:', error);
            });
    } else {
        console.error('Latitude and Longitude data is missing or invalid.');
    }
</script>


</html>
