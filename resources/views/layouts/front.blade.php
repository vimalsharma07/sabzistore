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
    <title>@yield('title', 'BharatStore') | {{ config('app.name', 'Laravel') }}</title>

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
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/desktopcart.css') }}">
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

    <nav class="pb-3 bg-light navbar navbar-expand-lg">
        <div class="container">
            <!-- Brand Logo -->
            <a class="text-danger navbar-brand brand-logo" href="{{ url('/') }}" style="font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                <span style="color: #FF9933;">Bharat</span> 
                <span style="color: #138808;">Store</span> 
              </a>
              
              

            <!-- Delivery Info -->
            <div class="gap-3 d-flex align-items-center">
                <div><i class="text-denger fa-solid fa-location-dot h4"></i></div>
                <div>
                    <h4 class="mb-1 fw-bold">Delivery in 8 minutes</h4>
                    <p class="m-0 text-muted delivery-address"> </p>
                </div>
            </div>



            <!-- Search Bar -->


            <form class="mx-auto w-75 d-flex" action="{{ url('/search') }}" method="GET">
                <div style="width: 400px; margin: 50px auto;" class="d-flex">

                    <input class="form-control search-bar" type="search" id="searchInput" placeholder='Search "Tomato"'
                        aria-label="Search" name="q">
                    <a href="#" class="px-3 bg-danger header-search input-group-text rounded-0"><i
                            class="icofont-search"></i></a>
                </div>
            </form>

            <!-- Account and Cart -->
            <ul class="flex-shrink-0 m-0 list-inline d-flex align-items-center ms-auto">
                @if (Auth::check())
                    <li class="m-0 list-inline-item dropdown">
                        <a href="#"
                            class="gap-2 p-3 link-dark text-decoration-none d-flex align-items-center text-start"role="button"
                            id="accountDropdown" data-bs-toggle="dropdown">
                            <i class="p-2 text-white bi bi-person h4 bg-danger rounded-pill"></i>
                            <div class="lh-sm d-none d-lg-block">
                                <h6 class="mb-0 fw-bold">Hello, Sign in</h6>
                                <small class="mb-0 align-bottom text-muted text-truncate d-inline-block small">My
                                    Account</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('orders/all') }}">Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <div class="dropdown me-3">
                        <a class="text-dark text-decoration-none" href="#" role="button" id="accountDropdown"
                            data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false">
                            Log In <i class="fas fa-chevron-down ms-1"></i>
                        </a>

                    </div>
                @endif


                <li class="m-0 list-inline-item">
                    <a href="#"
                        class="gap-2 p-3 text-decoration-none d-flex align-items-center text-start btn btn-success btn-lg rounded-pill border-start"
                        id="openCartBtn">
                        <i class="fas fa-shopping-cart text-danger fs-3"></i>
                        <div class="lh-sm d-none d-lg-block">
                            <h6 class="mb-0 text-white fw-bold" id="carttopright">3 items</h6>
                        </div>
                    </a>


                </li>
            </ul>

        </div>
    </nav>
    {{-- <button onclick="redirectToRoute()">Get Route on Google Maps</button> --}}

    <div class="container">


        <!-- Main Content Section -->
        <main>
            @if(Agent::isDesktop())
            @include('frontend.components.story.desktop')
            @endif

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
                                <li><a href="{{ url('/about') }}" class="text-dark text-decoration-none">About Us</a>
                                </li>
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
                            <p class="mb-0">&copy; 2024 @BharatStore All Rights Reserved.</p>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>
        var isMobile = @json(\Jenssegers\Agent\Facades\Agent::isMobile());
        var isDesktop = @json(\Jenssegers\Agent\Facades\Agent::isDesktop());
        var userAddress = @json($address);
    </script>

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
