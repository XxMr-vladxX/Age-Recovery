
function initMap() {
    const location = { lat: 32.47544479370117, lng: -114.7772216796875 };
    const map = new google.maps.Map(document.getElementById("map"), {
        center: location,
        zoom: 14,
    });
    new google.maps.Marker({
        position: location,
        map: map,
        title: "Mi ubicación",
    });

    // Forzar el ajuste del mapa si el tamaño del contenedor cambia
    google.maps.event.addListenerOnce(map, 'idle', function() {
        google.maps.event.trigger(map, "resize");
    });
}


