let userLat, userLng;

function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation, handleError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showLocation(position) {
    // Capture user latitude and longitude from position.coords
    userLat = position.coords.latitude;
    userLng = position.coords.longitude;

    // Call the OpenStreetMap API to get the location name
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${userLat}&lon=${userLng}&format=json`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const locationName = data.display_name; 
            $('.delivery-address').text(locationName);
            $('.address').val(locationName);
        })
        .catch((error) => {
            console.error("Error fetching location:", error);
        });
}

function handleError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

// Call the function to fetch the location
getUserLocation();
