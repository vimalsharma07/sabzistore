@extends(getLayout())

@section('content')
    <style>
        body {
            background-color: #f5f5f5;
        }

        .profile-header {
            text-align: center;
            padding: 20px;
            background: linear-gradient(to bottom right, #ff416c, #ff4b2b);
            border-bottom-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
            color: white;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 5px solid white;
        }

        .profile-header h2 {
            margin-top: 10px;
            font-size: 24px;
        }

        .profile-header p {
            margin: 0;
            font-size: 16px;
        }

        .orders-section {
            padding: 20px;
        }

        .orders-section .order-item {
            text-align: center;
            margin-bottom: 20px;
        }

        .orders-section .order-item i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .orders-section .order-item p {
            margin: 0;
            font-size: 14px;
        }

        .settings-section {
            padding: 20px;
        }

        .settings-section .settings-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .settings-section .settings-item i {
            font-size: 20px;
            margin-right: 10px;
        }

        .settings-section .settings-item p {
            margin: 0;
            font-size: 16px;
        }

        .logout-section {
            text-align: center;
            padding: 20px;
        }

        .logout-section a {
            color: #ff416c;
            font-size: 16px;
            text-decoration: none;
        }
    </style>
    @php
        $user = Auth::user();
    @endphp
    <div class="container">
        <div class="profile-header">
            <img alt="Profile picture of a person" src="{{ asset($user->photo) }}" />
            <h2>
                {{ $user->name ? $user->name : 'Customer' }}
            </h2>
            <p>
                SabziFarm
            </p>
        </div>

        <div class="py-3 m-0 row">
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/orders/all') }}">
                    <i class="m-0 text-center bi bi-view-list text-primary h1 cw-30"></i>
                    <a href="{{ url('/orders/all') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Orders</h5></a>
                    </a> 
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/address') }}">
                    <i class="m-0 text-center fas fa-truck text-warning h1 cw-30"></i>
                    <a href="{{ url('/address') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Address Book</h5></a> 
                    </a>
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/orders/pending') }}">
                    <i class="m-0 text-center fas fa-sync-alt text-danger h1 cw-30"></i>
                    <a href="{{ url('/orders/pending') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Processing</h5></a> 
                    </a>
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/orders/cancel') }}">
                    <i class="m-0 text-center fas fa-times-circle text-success h1 cw-30"></i>
                    <a href="{{ url('/orders/cancel') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Cancelled</h5></a> 
                    </a>
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/wishlist') }}">
                        <i class="m-0 text-center fas fa-heart text-danger h1 cw-30"></i>
                    <a href="{{ url('/wishlist') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Wishlist</h5></a> 
                    </a>
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="tel:+919368311855">
                    <i class="m-0 text-center fas fa-headset text-dark h1 cw-30"></i>
                    <a href="tel:+919368311855" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Support</h5></a>
                    </a> 
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/profile/edit') }}">
                    <i class="m-0 text-center fas fa-user text-warning h1 cw-30"></i>
                    <a href="{{ url('/profile/edit') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Update Profile</h5></a>
                    </a> 
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ url('/reviews') }}">
                        <i class="m-0 text-center fas fa-star text-warning h1"></i>
                        <a href="{{ url('/reviews') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Reviews</h5></a>
                    </a> 
                </div> 
            </div>
            <div class="px-1 col-4">
                <div class="p-3 mb-2 text-center bg-white rounded-4"> 
                    <a href="{{ route('logout') }}">
                    <i class="m-0 text-center fas fa-sign-out-alt text-warning h1 cw-30"></i>
                    <a href="{{ url('/logout') }}" class="col-4 order-item"><h5 class="mt-3 mb-1 fw-bold">Logout</h5></a> 
                    </a>
                </div> 
            </div>
            
        </div>
        <div class="pt-4 pb-5"></div>

        
    @endsection
