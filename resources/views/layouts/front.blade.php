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
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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
            color: #6c757d; /* Gray for address */
        }

        .search-bar {
            border-radius: 20px;
            background-color: #f8f9fa; /* Light gray background */
            border: none;
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
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand brand-logo" href="#">
                Sabzi<span>Store</span>
            </a>

            <!-- Delivery Info -->
            <div class="ms-4">
                <div class="delivery-time">Delivery in 8 minutes</div>
                <div class="delivery-address">
                    Home - 2106 orchid paramount
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>

            <!-- Search Bar -->
            <form class="d-flex mx-auto w-50">
                <input class="form-control search-bar" type="search" placeholder='Search "bread"' aria-label="Search">
            </form>

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
                <a href="#" class="btn cart-button">
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
                            <li><a href="#" class="text-dark text-decoration-none">About Us</a></li>
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
        
                    <!-- Social Media -->
                    <div class="col-md-4">
                        <h5 class="text-uppercase mb-3">Follow Us</h5>
                        <div>
                            <a href="#" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-dark text-decoration-none me-3">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-dark text-decoration-none">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

   
    <!-- Additional Scripts -->
    @yield('scripts')
</body>

</html>
