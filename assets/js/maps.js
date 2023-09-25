var map;
var currentMarker;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -7.010283, lng: 110.389072},
        zoom: 8
    });

    google.maps.event.addListener(map, 'rightclick', function(event) {
        placeMarker(event.latLng);
    });

    var longpressTimer;
    var startPressTime;

    google.maps.event.addListener(map, 'mousedown', function(event) {
        startPressTime = new Date().getTime();
        longpressTimer = setTimeout(function() {
            placeMarker(event.latLng);
        }, 1000);
    });

    google.maps.event.addListener(map, 'mouseup', function(event) {
        clearTimeout(longpressTimer);
    });

    google.maps.event.addListener(map, 'mousemove', function(event) {
        clearTimeout(longpressTimer);
    });
}

function placeMarker(location) {
    if (currentMarker) {
        currentMarker.setMap(null);
    }
    currentMarker = new google.maps.Marker({
        position: location,
        map: map
    });
}

function saveMarkerData() {
    var markerData = getMarkerData();
    if (markerData) {
        fetch('../adu_tambah.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `lat=${markerData.lat}&lng=${markerData.lng}`
        })
        .then(response => response.text())
        .then(data => alert(data))
        .catch((error) => {
            console.error('Error:', error);
        });
    } else {
        alert("No marker to save.");
    }
}

function getMarkerData() {
    if (currentMarker) {
        var position = currentMarker.getPosition();
        return {
            lat: position.lat(),
            lng: position.lng()
        };
    }
    return null;
}

function moveToCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            placeMarker(pos);
        }, function() {
            handleLocationError(true);
        });
    } else {
        handleLocationError(false);
    }
}


function handleLocationError(browserHasGeolocation) {
    alert(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
}

// Event when the modal is shown
$('#mapModal').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    moveToCurrentLocation();
});
