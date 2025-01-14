<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SabziStore') | {{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet"  type="text/css" href="{{ asset('/assets/frontend/css/mobilecart.css') }}">
    <link rel="stylesheet"  type="text/css" href="{{ asset('/assets/frontend/css/mobilehome.css') }}">

    
</head>

<body>
    <!-- Top Navbar -->
<div class="navbar">
        {{-- <h1>SabziStore</h1> --}}
        <div class="search-bar">
            <input type="text" class="form-control" placeholder='Search "disposables"' id="searchInput">
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="content">
       

        @yield('content')
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-bar">
        <a href="{{url('/')}}" class="active">
            <i class="fas fa-home"></i>
            <p>Home</p>
        </a>
        @if(Auth::check())
        <a href="{{url('/orders/all')}}">
            <i class="fas fa-box"></i>
            <p>Orders</p>
        </a>
        <a href="{{url('/profile')}}">
            <i class="fas fa-user"></i>
            <p>Profile</p>
        </a>
        @else
        {{-- <a href="{{url('/products/popular')}}">
            <i class="fas fa-box"></i>
            <p>Popular</p>
        </a> --}}
        <a href="#"  data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false">
            <i class="fas fa-user"></i>
            <p>Login</p>
        </a>
        @endif
        <a href="{{url('/cart')}}">
            <i class="fas fa-shopping-cart"></i>
            <p>Cart</p>
        </a>
    </div>
 @if(url()->current() == url('/'))
    @include('frontend.components.cart.mobileviewcart')
@endif
@include('frontend.components.login.desktoplogin')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('assets/frontend/js/cart.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/currentlocation.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/placeholder.js') }}"></script>
    <script>
        var isMobile = @json(\Jenssegers\Agent\Facades\Agent::isMobile());
        var isDesktop = @json(\Jenssegers\Agent\Facades\Agent::isDesktop());
    </script>
    @yield('scripts')
</body>

</html>
