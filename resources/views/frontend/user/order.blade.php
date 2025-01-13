@extends(getLayout())
@section('content')
@php
      $user = Auth::user();
      $address = DB::table('address')->where('id', $order->address)->first();
    @endphp
<div class="container">
    <h1>Order View</h1>

    <!-- Displaying Order Details -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Number: {{ $order->order_number }}</h5>
            <p><strong>Address:</strong>{{$address->houseno}} {{$address->appartment}} {{ $address->address }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
            <p><strong>Created At:</strong> {{ $order->created_at }}</p>
            <p><strong>Grand Total:</strong> ₹{{ number_format($order->grand_total, 2) }}</p>
            <p><strong>Total Pay:</strong> ₹{{ number_format($order->total_pay, 2) }}</p>
        </div>
    </div>

    <!-- Displaying Product Details from JSON -->
    <h3>Products in Order</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $products = json_decode($order->products, true);  
            @endphp
            @foreach ($products as $product)
           
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] ?? 'Unknown Product' }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>₹{{ number_format($product['price'], 2) }}</td>
                    <td>₹{{ number_format($product['price'] * $product['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Displaying Fees and Discounts -->
    <h3>Fees and Discounts</h3>
    <ul>
        <li><strong>Tip:</strong> ₹{{ number_format($order->tip, 2) }}</li>
        <li><strong>Delivery Fee:</strong> <strike> ₹ {{ number_format($order->delivery_fee, 2) }} </strike> ₹{{ number_format($order->discounted_delivery_fee, 2) }}</li>
        <li><strong>Handling Fee:</strong>  <strike>> ₹{{ number_format($order->handling_fee, 2) }} </strike> ₹{{ number_format($order->discounted_handling_fee, 2) }}</li>
        @if($order->discounted_small_cart_fee != 0)
            <li><strong>Small Cart Fee:</strong>  <strike> ₹{{ number_format($order->small_cart_fee, 2) }} </strike>  ₹{{ number_format($order->discounted_small_cart_fee, 2) }}</li>
            @endif
            @if($order->coupon_discounted!=0)
        <li><strong>Coupon:</strong> {{ $order->coupon ?? 'None' }}</li>
        <li><strong>Coupon Discounted:</strong> ₹{{ number_format($order->coupon_discounted, 2) }}</li>
        @endif
    </ul>

    <!-- Download Invoice Button -->
    <div class="row md-4">
        <!-- First button: Download Invoice -->
        <div class="col-12 col-md-6 mb-3">
            <form action="{{ route('orders.invoice', ['id' => $order->id]) }}" method="get">
                <button type="submit" class="btn btn-primary w-100">Download Invoice</button>
            </form>
        </div>
    
        <!-- Second button: See Address on Map -->
        @if($address->lat && $address->lang && $user->role=='admin')
            <div class="col-12 col-md-6 mb-3">
                <button onclick="redirectonmap({{ $address->lat }}, {{ $address->lang }})" class="btn btn-primary w-100">
                    See Address on map
                </button>
            </div>
        @endif
    </div>
    
</div>

@endsection
