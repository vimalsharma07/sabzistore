<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Default meta description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Laravel, PHP, Bootstrap')">
    <meta name="author" content="@yield('meta_author', 'Your Name or Company')">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('og_title', 'Default OG Title')">
    <meta property="og:description" content="@yield('og_description', 'Default OG Description')">
    <meta property="og:image" content="@yield('og_image', asset('default-og-image.png'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="website">

    <!-- Title -->
    <title>@yield('title', 'SabziStore') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/uploads/media/logo.png') }}" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <!-- Additional CSS -->
    @stack('styles')
     
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        
        .brand-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f9c900; /* Yellow for Sabzi */
        }

        .brand-logo span {
            color: #28a745; /* Green for Mart */
        }

        .delivery-time {
            font-weight: bold;
            color: #000; /* Black */
        }

        .delivery-address {
            font-size: 0.9rem;
            color: #6c757d; 
            width: 60%;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .cart-button {
            background-color: #28a745; /* Green */
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
        }

        .cart-button i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    @php
    $cart = session()->get('cart', []);
    // dd($cart);
@endphp

    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand brand-logo" href="{{url('/')}}">
                Sabzi<span>Store</span>
            </a>

            <!-- Delivery Info -->
            <div class="ms-4">
                <div class="delivery-time">Delivery in 8 minutes</div>
                <div class="delivery-address">
                    Select Address
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>

            <!-- Search Bar -->
            <form class="d-flex mx-auto w-50"  action="{{url('/search')}}" method="GET">
                <div style="max-width: 400px; margin: 50px auto;">
                    <input 
                        class="form-control search-bar" 
                        type="search" 
                        id="searchInput" 
                        placeholder='Search "Tomato"'
                        aria-label="Search" 
                        name="q">
                </div>            </form>

            <!-- Account and Cart -->
            <div class="d-flex align-items-center">
                <div class="dropdown me-3">
                    <a class="text-dark text-decoration-none" href="#" role="button" id="accountDropdown"
                    data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false">
                        Account <i class="fas fa-chevron-down ms-1"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Orders</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
                <a href="#" class="btn cart-button" onclick="openCart()">
                    <i class="fas fa-shopping-cart"></i> 1 items ₹90
                </a>
            </div>
        </div>
    </nav>
    {{-- <button onclick="redirectToRoute()">Get Route on Google Maps</button> --}}

    <div class="container">
       
        

        <!-- Main Content Section -->
        <main>
            @yield('content')
        </main>

        <!-- Footer Section -->
        @section('footer')
        <footer class="bg-white text-dark py-4 w-100 d-none d-md-block">
            <div class="container">
                <div class="row">
                    <!-- Useful Links -->
                    <div class="col-md-4">
                        <h5 class="text-uppercase mb-3">Useful Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark text-decoration-none">Home</a></li>
                            <li><a href="{{url('/about')}}" class="text-dark text-decoration-none">About Us</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Services</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Contact</a></li>
                        </ul>
                    </div>
        
                    <!-- Categories -->
                    <div class="col-md-4">
                        <h5 class="text-uppercase mb-3">Categories</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark text-decoration-none">Technology</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Business</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Travel</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Health</a></li>
                        </ul>
                    </div>
        <?php 
       $media=  DB::table('media')->first();
          ?>
                    <!-- Social Media -->
                    <div class="col-md-4">
                        <h5 class="text-uppercase mb-3">Follow Us</h5>
                        <div>
                            <a href="{{$media->facebook}}" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{$media->twitter}}" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{$media->instagram}}" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{$media->linkedin}}" class="text-dark text-decoration-none">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
        
                <div class="row mt-4">
                    <div class="col text-center">
                        <p class="mb-0">&copy; 2024 @SabziStore All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    
        @show
    </div>
    @include('frontend.components.login.desktoplogin')
    @include('frontend.components.cart.desktopcart')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Slick Slider
            $('.slider').slick({
                dots: false,                // Show dots for navigation
                infinite: false,            // Infinite loop
                speed: 500,                // Transition speed
                slidesToShow: 4,           // Show 4 products at once on larger screens
                slidesToScroll: 1,         // Scroll 1 product at a time
                autoplay: true,            // Enable autoplay
                autoplaySpeed: 3000,       // Autoplay interval in milliseconds
                arrows: true,              // Show arrows for navigation
                responsive: [              // Define breakpoints for responsiveness
                    {
                        breakpoint: 1024,  // Tablet (below 1024px)
                        settings: {
                            slidesToShow: 3,   // Show 3 products
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,   // Mobile (below 768px)
                        settings: {
                            slidesToShow: 2,   // Show 2 products
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,   // Mobile (below 576px)
                        settings: {
                            slidesToShow: 1,   // Show 1 product
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        // Function to show the cart
        function openCart() {
            const cart = document.getElementById('cart');
            cart.classList.add('show-cart');
        }
      
        // Function to hide the cart
        function closeCart() {
            const cart = document.getElementById('cart');
            cart.classList.remove('show-cart');
        }
      
        // Optionally, you can add a button or event to trigger `openCart()`
        // Example: openCart(); to show the cart when needed.
      </script>
      
      <script src="{{asset('assets/frontend/js/cart.js')}}"></script>
<script>
    let userLat, userLng;

function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation, handleError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showLocation(position) {
    // Capture user latitude and longitude
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${userLat}&lon=${userLng}&format=json`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const locationName = data.display_name; 
           $('.delivery-address').text(locationName);
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
getUserLocation();
showLocation();
</script>
<script>
     const searchInput = document.getElementById("searchInput");

// Suggestions for the placeholder animation
const suggestions = [
    "carrot",
    "potato",
    "tomato",
    "onion",
    "spinach",
    "broccoli",
    "cucumber",
    "cauliflower",
    "peas",
    "zucchini",
    "bell pepper",
    "cabbage",
    "lettuce",
    "garlic",
    "ginger",
    "eggplant",
    "mushroom",
    "pumpkin",
    "radish",
    "beetroot",
    "sweet corn",
    "chili",
    "okra",
    "celery",
    "parsley",
    "kale",
    "asparagus",
    "turnip",
    "brussels sprouts",
    "leek",
    "fennel",
    "artichoke",
    "bok choy",
    "arugula",
    "watercress"
];


let currentIndex = 0;

function animatePlaceholder() {
    searchInput.placeholder = `Search "${suggestions[currentIndex]}"`;
    currentIndex = (currentIndex + 1) % suggestions.length; // Loop back to the first suggestion
}

// Change placeholder every 2 seconds
setInterval(animatePlaceholder, 2000);
</script>
    @yield('scripts')
</body>

</html>
