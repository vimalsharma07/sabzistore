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
    <!-- Additional CSS -->
    @stack('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>
    @php
        $cart = session()->get('cart', []);
        $user = Auth::user();
        if ($user) {
            $address = DB::table('address')->where('user_id', $user->id)->where('default', 1)->first();
        } else {
            $address = '';
        }
    @endphp

    <nav class="py-3 bg-danger navbar navbar-expand-lg">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand brand-logo" href="{{ url('/') }}">
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
            <form class="mx-auto d-flex w-50" action="{{ url('/search') }}" method="GET">
                <div style="max-width: 400px; margin: 50px auto;">
                    <input class="form-control search-bar" type="search" id="searchInput" placeholder='Search "Tomato"'
                        aria-label="Search" name="q">
                </div>
            </form>

            <!-- Account and Cart -->
            <div class="d-flex align-items-center">
                @if (Auth::check())
                    <div class="dropdown me-3">
                        <a class="text-dark text-decoration-none" href="#" role="button" id="accountDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account <i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('orders/all') }}">Orders</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown me-3">
                        <a class="text-dark text-decoration-none" href="#" role="button" id="accountDropdown"
                            data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false">
                            Log In <i class="fas fa-chevron-down ms-1"></i>
                        </a>

                    </div>
                @endif
                <a href="#" class="btn cart-button" id="openCartBtn">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="carttopright"> </span>
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
        @if (request()->segment(1) != 'cart')
            @include('frontend/components/cart/desktopcart');
        @endif
        <!-- Footer Section -->
        @section('footer')
            <footer class="py-4 bg-white text-dark w-100 d-none d-md-block">
                <div class="container">
                    <div class="row">
                        <!-- Useful Links -->
                        <div class="col-md-4">
                            <h5 class="mb-3 text-uppercase">Useful Links</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-dark text-decoration-none">Home</a></li>
                                <li><a href="{{ url('/about') }}" class="text-dark text-decoration-none">About Us</a></li>
                                <li><a href="#" class="text-dark text-decoration-none">Services</a></li>
                                <li><a href="#" class="text-dark text-decoration-none">Contact</a></li>
                            </ul>
                        </div>

                        <!-- Categories -->
                        <div class="col-md-4">
                            <h5 class="mb-3 text-uppercase">Categories</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-dark text-decoration-none">Technology</a></li>
                                <li><a href="#" class="text-dark text-decoration-none">Business</a></li>
                                <li><a href="#" class="text-dark text-decoration-none">Travel</a></li>
                                <li><a href="#" class="text-dark text-decoration-none">Health</a></li>
                            </ul>
                        </div>
                        <?php
                        $media = DB::table('media')->first();
                        ?>
                        <!-- Social Media -->
                        <div class="col-md-4">
                            <h5 class="mb-3 text-uppercase">Follow Us</h5>
                            <div>
                                <a href="{{ $media->facebook }}" class="text-dark text-decoration-none me-3">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $media->twitter }}" class="text-dark text-decoration-none me-3">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ $media->instagram }}" class="text-dark text-decoration-none me-3">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ $media->linkedin }}" class="text-dark text-decoration-none">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 row">
                        <div class="text-center col">
                            <p class="mb-0">&copy; 2024 @SabziStore All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>

            @php
                $cart = session('cart', []);

                $itemTotal = 0;
                $totalqty = 0;
                foreach ($cart as $item) {
                    $price = array_values($item['attributes'])[0] * $item['quantity'];
                    $itemTotal += $price;
                    $totalqty++;
                }

            @endphp
        @show
    </div>
    @include('frontend.components.login.desktoplogin')
    @include('frontend.components.cart.desktopcart')

    <!-- jQuery -->


    <script>
        var isMobile = @json(\Jenssegers\Agent\Facades\Agent::isMobile());
        var isDesktop = @json(\Jenssegers\Agent\Facades\Agent::isDesktop());
        var userAddress = @json($address);
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/frontend/js/cart.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/currentlocation.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/placeholder.js') }}"></script>
    {{-- <script src="{{asset('assets/frontend/js/rating.js')}}"></script> --}}
    <script src="{{ asset('assets/frontend/js/loginmodal.js') }}"></script>
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



    <script>
        $(document).ready(function() {



            var totalQty = @json($totalqty);
            var itemTotal = @json($itemTotal);

            console.log(totalQty, itemTotal);
            $('#carttopright').text(totalQty + " items ₹" + itemTotal);
        });
    </script>
    @yield('scripts')
</body>

</html>
