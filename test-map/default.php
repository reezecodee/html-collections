<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Batas Wilayah Desa Kaputihan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 70vh;
            width: 100%;
        }

        iframe {
            width: 100%;
            height: 450px;
            border: 0;
        }
    </style>
</head>

<body>
    <h2>Map Batas Wilayah Desa Kaputihan Tasikmalaya Via Google Map</h2>
    <!-- Iframe Google Maps -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30096.705733042778!2d108.23830479595121!3d-7.467912086528193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65f74431dd6991%3A0x769bfbbbc3a230ba!2sKaputihan%2C%20Kec.%20Jatiwaras%2C%20Kabupaten%20Tasikmalaya%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1738315610060!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <h2>Map Batas Wilayah Desa Kaputihan Tasikmalaya Via GeoJSON dan Leaflet</h2>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inisialisasi map tanpa set view manual
        var map = L.map('map');

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Fetch data GeoJSON dari kaputihan.geojson
        fetch('kaputihan.geojson')
            .then(response => response.json())
            .then(geojsonData => {
                // Tambahkan GeoJSON ke map
                var geojsonLayer = L.geoJSON(geojsonData, {
                    style: function() {
                        return {
                            color: 'blue',
                            weight: 2,
                            fillOpacity: 0.5
                        };
                    }
                }).addTo(map);

                // Pastikan map memuat seluruh area GeoJSON tanpa terpotong
                var bounds = geojsonLayer.getBounds();
                map.fitBounds(bounds);

                // Hitung pusat koordinat dari GeoJSON bounds
                var center = bounds.getCenter();

                // Tambahkan marker di titik tengah dengan popup
                L.marker([center.lat, center.lng])
                    .addTo(map)
                    .bindPopup("<b>Desa Kaputihan</b><br>Kabupaten Tasikmalaya")
                    .openPopup();
            })
            .catch(error => {
                console.error('Error fetching GeoJSON:', error);
            });
    </script>


</body>

</html>