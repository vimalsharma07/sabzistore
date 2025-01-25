<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SabziStore') | {{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/css/mobilecart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/css/mobilehome.css') }}"> --}}




    <link rel="stylesheet" href="{{ asset('assets/frontend/vender/bootstrap/css/bootstrap.min.css') }}">
    <!-- Icofont -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vender/icons/icofont.min.css') }}">
    <!-- Slick SLider Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vender/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/vender/slick/slick/slick-theme.css') }}">
    <!-- Font Awesome Icon -->
    <link href="{{ asset('assets/frontend/vender/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{ asset('assets/frontend/vender/sidebar/demo.css') }}" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">


</head>

<body class="bg-light">
    <!-- Top Navbar -->

    <!-- Navbar -->
    <div class="px-4 pt-4 osahan-header-nav d-flex align-items-center bg-danger">
        <h2 class="mb-0 text-white font-weight-normal">
            <a class="text-white navbar-brand brand-logo" href="{{ url('/') }}">
                Sabzi<span>Store</span>
            </a>
            </h5>
            <div class="gap-2 ms-auto d-flex align-items-center">
                <a href="notifications.html" class="text-white"><i
                        class="m-0 bi bi-bell-fill d-flex h3 header-bell"></i></a>
                <a class="m-0 text-white toggle osahan-toggle" href="#"><i
                        class="m-0 bg-black bi bi-list d-flex h3 header-list"></i></a>
            </div>
    </div>
    <div class="px-4 py-3 shadow-sm bg-danger">
        <form action="{{url('/search')}}" method="GET">
        <div class="p-1 mb-5 overflow-hidden bg-white border-0 input-group rounded-pill">
            <span class="bg-white border-0 input-group-text border-end pe-0"><i
                    class="fa-solid fa-magnifying-glass text-danger"></i></span>
            <input type="text" class="border-0 shadow-none form-control" placeholder='Search "disposables"'
                id="searchInput" name="q">
            <button type="submit" class="bg-white border-0 input-group-text text-decoration-none"><i
                    class="fa-solid fa-microphone text-success"></i></button>
        </div>
    </form>
    </div>




    <!-- Scrollable Content -->
    <div class="content">


        @yield('content')
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="fixed-bottom bg-white shadow px-3 py-2 osahan-nav-bottom">
        <div class="row links">
            <div class="col osahan-nav-bottom-link text-center">
                <a href="{{ url('/') }}">
                    <span><i class="bi bi-house-fill h1"></i></span>
                    <p class="m-0">Home</p>
                </a>
            </div>
            <div class="col osahan-nav-bottom-link p-0 text-center">
                <a href="{{url('/categories')}}">
                    <span><i class="bi bi-shop h1"></i></span>
                    <p class="m-0">Categories</p>
                </a>
            </div>
           @if(Auth::check())
            <div class="col osahan-nav-bottom-link osahan-nav-bottom-link-center">
                <a class="osahan-nav-bottom-home" href="{{url('/profile')}}">
                    <span><i class="bi bi-person h1"></i></span>
                </a>
            </div>
            @else
            <div   data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false"  class="col osahan-nav-bottom-link osahan-nav-bottom-link-center">
                <a class="osahan-nav-bottom-home" href="javascript:void(0)">
                    <span><i class="bi bi-person h1"></i></span>
                </a>
            </div>
            @endif
           @if(Auth::check())
            <div class="col osahan-nav-bottom-link p-0 text-center">
                <a href="{{url('/orders/all')}}">
                    <span><i class="bi bi-receipt h1"></i></span>
                    <p class="m-0">Orders</p>
                </a>
            </div>
            @else
            <div class="col osahan-nav-bottom-link p-0 text-center"> 
                <a href="{{url('/search/?q="green"')}}">
                    <span><i class="bi bi-receipt h1"></i></span>
                    <p class="m-0" style="color: green">GreenVeg</p>
                </a>
            </div>
            @endif
            <div class="col osahan-nav-bottom-link p-0 text-center">
                <a href="{{url('/cart')}}">
                    <span><i class="bi bi-basket h1"></i></span>
                    <p class="m-0">Cart</p>
                </a>
            </div>
        </div>
    </div>

    @if (url()->current() == url('/'))
        @include('frontend.components.cart.mobileviewcart')
    @endif
    @include('frontend.components.login.desktoplogin')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/frontend/js/cart.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/currentlocation.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/placeholder.js') }}"></script>
     {{-- <script src="{{asset('assets/frontend/js/rating.js')}}"></script> --}}
     <script src="{{asset('assets/frontend/js/loginmodal.js')}}"></script>

    <script>
        var isMobile = @json(\Jenssegers\Agent\Facades\Agent::isMobile());
        var isDesktop = @json(\Jenssegers\Agent\Facades\Agent::isDesktop());
    </script>


    {{-- new --}}
    <!-- Bootstrap core JavaScript -->
  
    <script src="{{ asset('assets/frontend/vender/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript">
    </script>
    <!-- slick Slider JS-->
    <script src="{{ asset('assets/frontend/vender/slick/slick/slick.min.js') }}" type="text/javascript"></script>
    <!-- Sidebar JS-->
    <script src="{{ asset('assets/frontend/vender/sidebar/hc-offcanvas-nav.js') }}" type="text/javascript"></script>
    <!-- Javascript -->
    <script src="{{ asset('assets/frontend/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/frontend/js/rocket-loader.min.js') }}" type="text/javascript"></script>

    @yield('scripts')
</body>

</html>
