@extends(getLayout())

@section('content')
<div class="container mt-5">
    <!-- Mobile Design -->
    <div class="card p-4 shadow-lg d-md-none" style="border-radius: 15px; background: #f6f8f5;">
        <h3 class="text-center mb-4" style="color: #1e5631;">Add Address</h3>
<form id="addressForm" action="{{ route('address.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
                <label for="towerFlat" style="color: #1e5631;">Tower/Flat Number</label>
                <input type="text" class="form-control" id="towerFlat" name="houseno" placeholder="Enter tower or flat number" required>
            </div>
            <div class="form-group mb-3">
                <label for="societyAppartment" style="color: #1e5631;">Society/Apartment</label>
                <input type="text" class="form-control" id="societyAppartment" name="appartment" placeholder="Enter society or apartment name" required>
            </div>
            <div class="form-group mb-3">
                <label for="address" style="color: #1e5631;">Address</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2 address" id="address" name="address" placeholder="Enter your address" required>
                    <button type="button" id="getLocationBtn" class="btn btn-outline-success" onclick="getCurrentLocation()">Get Current Location</button>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="landmark" style="color: #1e5631;">Landmark (Optional)</label>
                <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Enter a nearby landmark">
            </div>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lang" name="lang">
            <button type="submit" class="btn btn-success w-100">Submit Address</button>
        </form>
    </div>

    <!-- Desktop Design -->
    <div class="card p-5 shadow-lg d-none d-md-block" style="border-radius: 15px; background: linear-gradient(135deg, #d4edda, #f6f8f5);">
        <h2 class="text-center mb-5" style="color: #1e5631;">Add Your Address</h2>
<form id="addressForm" action="{{ route('address.store') }}" method="POST">
    @csrf
    <div class="row mb-3">
                <div class="col-md-6">
                    <label for="towerFlatDesktop" style="color: #1e5631;">Tower/Flat Number</label>
                    <input type="text" class="form-control" id="towerFlatDesktop" name="houseno" placeholder="Enter tower or flat number" required>
                </div>
                <div class="col-md-6">
                    <label for="societyAppartmentDesktop" style="color: #1e5631;">Society/Apartment</label>
                    <input type="text" class="form-control" id="societyAppartmentDesktop" name="appartment" placeholder="Enter society or apartment name" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="addressDesktop" style="color: #1e5631;">Address</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="addressDesktop" name="address" placeholder="Enter your address" required>
                    <button type="button" id="getLocationBtnDesktop" class="btn btn-outline-success" onclick="getCurrentLocation()">Get Current Location</button>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="landmarkDesktop" style="color: #1e5631;">Landmark (Optional)</label>
                <input type="text" class="form-control" id="landmarkDesktop" name="landmark" placeholder="Enter a nearby landmark">
            </div>
            <input type="hidden" id="latDesktop" name="lat">
            <input type="hidden" id="langDesktop" name="lang">
            <button type="submit" class="btn btn-success w-100">Submit Address</button>
        </form>
    </div>
</div>

<script>
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Populate latitude and longitude fields
                document.getElementById('lat').value = lat;
                document.getElementById('lang').value = lng;
                document.getElementById('latDesktop').value = lat;
                document.getElementById('langDesktop').value = lng;

                // Fetch human-readable address
                const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const locationName = data.display_name;
                        document.querySelectorAll('.address').forEach(input => {
                            input.value = locationName;
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching location:", error);
                    });
            }, function () {
                alert("Unable to fetch location.");
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
</script>
@endsection
