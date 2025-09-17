$(document).ready(function () {
    // Initialize the map
    var map = L.map('map').setView([34.5553, 69.2075], 6);

    // Use Carto Light tiles (labels in English)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    // Branch data
    var branches = [
        { lat: 34.34858, lng: 62.20332, name: "Herat Branch" },
        { lat: 34.55008, lng: 69.16439, name: "Kabul Branch" },
        { lat: 34.50134, lng: 69.07385, name: "Kabul Brachi Branch" },
        { lat: 36.71499, lng: 67.10981, name: "Mazar-i-sharif Branch" },
        { lat: 31.61983, lng: 65.72701, name: "Kandahar Branch" },
        { lat: 30.94696, lng: 61.91795, name: "Nimruz Branch" }
    ];

    // Add markers for each branch
    branches.forEach(branch => {
        L.marker([branch.lat, branch.lng]).addTo(map)
            .bindPopup(branch.name);
    });
});
