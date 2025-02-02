@extends(getLayout())
@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .header {
        background-color: #2b7a0b;
        color: white;
        padding: 50px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .header img {
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: auto;
        opacity: 0.8;
    }
    .header h1 {
        font-size: 3rem;
        font-weight: 600;
    }
    .header button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .header button:hover {
        background-color: #3a8c3e;
    }
    .content {
        padding: 50px 0;
        text-align: center;
    }
    .content img {
        width: 50%;
        height: auto;
    }
    .content h2 {
        font-size: 2rem;
        font-weight: 600;
        margin-top: 20px;
        color: #2b7a0b;
    }
    .content p {
        font-size: 1rem;
        margin: 20px 0;
        color: #555;
    }
    .content ul {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }
    .content ul li {
        font-size: 1rem;
        margin: 10px 0;
        color: #2b7a0b;
    }
    .content ul li i {
        color: #4caf50;
        margin-right: 10px;
    }
    .content button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .content button:hover {
        background-color: #3a8c3e;
    }
</style>

<div class="header">
    <h1>SabziStore - Farm Fresh at Your Doorstep</h1>
    <button>Shop Now</button>
    <img src="{{ asset('assets/images/vege.webp') }}" alt="Vegetable Image">
</div>

<div class="container content">
    <img src="{{ asset('assets/images/vege.webp') }}" alt="Vegetable Image">
    <h2>Fresh, Organic, and Delivered Fast!</h2>
    <p>
        At SabziStore, we bring farm-fresh vegetables to your doorstep within 15-20 minutes. Enjoy the goodness of nature with sustainably grown produce.
    </p>
    <ul>
        <li><i class="fas fa-check-circle"></i> Farm Fresh Vegetables</li>
        <li><i class="fas fa-check-circle"></i> No Harmful Chemicals</li>
        <li><i class="fas fa-check-circle"></i> Fast Delivery</li>
        <li><i class="fas fa-check-circle"></i> Sustainable Practices</li>
    </ul>
    <button>Learn More</button>
</div>
@endsection
