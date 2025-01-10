<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SabziStore') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background-color: #004d40;
            color: white;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #004d40;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 18px;
            margin: 0;
        }

        .navbar .search-bar {
            flex-grow: 1;
            margin-left: 15px;
        }

        .content {
            flex: 1;
            margin-top: 60px;
            margin-bottom: 60px;
            overflow-y: auto;
            padding: 15px;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #004d40;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        }

        .bottom-bar a {
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            flex: 1;
        }

        .bottom-bar a i {
            font-size: 20px;
        }

        .bottom-bar a.active {
            color: #ffeb3b;
        }

        .category-card {
            background-color: #ffeb3b;
            border-radius: 10px;
            text-align: center;
            padding: 10px;
            margin: 10px 5px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .category-card h5 {
            margin: 10px 0 0;
            color: black;
        }

        @media (max-width: 768px) {
            .navbar h1 {
                font-size: 16px;
            }

            .category-card h5 {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Top Navbar -->
<div class="navbar @if(url()->current() == url('cart')) d-none @endif">
        <h1>SabziStore</h1>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder='Search "disposables"'>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="content">
       

        @yield('content')
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-bar  @if(url()->current() == url('cart')) d-none @endif">
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
 @if(url()->current() == url('/'))
    @include('frontend.components.cart.mobileviewcart')
@endif
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('assets/frontend/js/cart.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/currentlocation.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/placeholder.js') }}"></script>

    @yield('scripts')
</body>

</html>
