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
  $user=   Auth::user();
 @endphp
  <div class="container">
   <div class="profile-header">
    <img alt="Profile picture of a person" src="{{ asset($user->photo) }}"/>
    <h2>
     {{$user->name?$user->name:'Customer'}}
    </h2>
    <p>
     SabziFarm
    </p>
   </div>
   <div class="orders-section row text-center">
    <a  href="{{url('/orders/all')}}" class="col-4 order-item">
     <i class="fas fa-clock text-primary">
     </i>
     <p>
       Orders
     </p>
    </a>
    <a  href="{{url('/address')}}" class="col-4 order-item">
     <i class="fas fa-truck text-warning">
     </i>
     <p>
       Address Book
     </p>
    </a>
    <a   href="{{url('/orders/pending')}}" class="col-4 order-item">
     <i class="fas fa-sync-alt text-danger">
     </i>
     <p>
      Processing
     </p>
    </a>
    <a   href="{{url('/orders/cancel')}}" class="col-4 order-item">
        <i class="fas fa-times-circle text-success">
     </i>
     <p>
      Cancelled
     </p>
    </a>
    <a   href="{{url('/wishlist')}}" class="col-4 order-item">
        <i class="fas fa-heart text-danger">
     </i>
     <p>
      Wishlist
     </p>
    </a>
    <a href="tel:+919368311855" class="col-4 order-item">
        <i class="fas fa-headset text-primary">
     </i>
     <p>
      Support
     </p>
    </a>

    <a href="{{url('/profile/edit')}}" class="col-4 order-item">
        <i class="fas fa-user text-primary">
     </i>
     <p>
      Update Profile
     </p>
    </a>
  
   <div class="logout-section">
    <a href="{{url('/logout')}}">
     <i class="fas fa-sign-out-alt">
     </i>
     Logout
    </a>
   </div>
  </div>
 @endsection