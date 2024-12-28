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
        body {
            background-color: #004d40;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Category Card Hover Effect */
        .category-card {
            background-color: #ffeb3b;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            margin: 10px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .category-card img {
            width: 100%;
            border-radius: 10px;
        }

        .category-card h5 {
            margin-top: 10px;
            color: #000;
        }

        /* Bottom Bar Animation */
        .bottom-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #004d40;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }
        .navbar{
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #004d40;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .bottom-bar a {
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }

        .bottom-bar a:hover {
            color: #ffeb3b;
            transform: scale(1.1);
        }

        .bottom-bar i {
            font-size: 24px;
        }

        .bottom-bar a.active {
            color: #ffeb3b;
        }

        /* Mobile responsive tweaks */
        @media (max-width: 767px) {
            .category-card h5 {
                font-size: 14px;
            }

            .bottom-bar {
                font-size: 14px;
            }

            .bottom-bar a {
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container fade-in">
        <div class="navbar">
        <div class="text-center my-3">
            <h1>SabziStore in <strong>8 minutes</strong></h1>
            <p>HOME - Mapple B, 5007, Floor <i class="fas fa-chevron-down"></i></p>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <div class="input-group">
                <input type="text" class="form-control" placeholder='Search "disposables"'>
                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Home Tab Content -->
                <div class="d-flex justify-content-around my-3">
                    <div class="text-center category-card">
                        <i class="fas fa-th-large"></i>
                        <h5>All</h5>
                    </div>

                    <div class="text-center category-card">
                        <i class="fas fa-headphones-alt"></i>
                        <h5>Electronics</h5>
                    </div>

                    <div class="text-center category-card">
                        <i class="fas fa-heart"></i>
                        <h5>Beauty</h5>
                    </div>

                    <div class="text-center category-card">
                        <i class="fas fa-child"></i>
                        <h5>Kids</h5>
                    </div>

                    <div class="text-center category-card">
                        <i class="fas fa-gift"></i>
                        <h5>Gifting</h5>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <div class="bottom-bar">
            <a href="#" class="active">
                <i class="fas fa-home"></i>
                <p>Home</p>
            </a>
            <a href="#">
                <i class="fas fa-box"></i>
                <p>Orders</p>
            </a>
            <a href="#">
                <i class="fas fa-user"></i>
                <p>Profile</p>
            </a>
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
                <p>Cart</p>
            </a>
        </div>
    </div>
    @include('frontend.components.cart.mobileviewcart')

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb5r7SfrV3wVP5kK3g9On3sWp8cQnqNfX40ZfXwLvQJ0X7r1Pp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-cuGxyjr9Lw2R8tA2vO1kxr/lfuC8mC1dQf3Ak7SzkVpdCZ5N7LFoU8ScGFz9lOWr" crossorigin="anonymous"></script>

    @yield('scripts')
</body>

</html>
