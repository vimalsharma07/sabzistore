@extends(getLayout())

@section('content')
<div class="container" style="padding: 20px;">
    <div class="card" style="border: 2px solid #388E3C; border-radius: 8px;">
        <div class="card-header" style="background-color: #C8E6C9; color: #2E7D32; font-size: 24px; text-align: center;">
            Order Confirmation
        </div>
        <div class="card-body" style="background-color: #F9FBE7;">
            <h2 style="color: #388E3C;">Thank you for your order!</h2>
            <p style="font-size: 18px; color: #555;">
                Your order has been successfully placed. Below are your order details:
            </p>
            <div style="margin-top: 10px;">
                <strong style="color: #2E7D32;">Order Number:</strong> <span style="color: #FFEB3B;">{{ $order_number }}</span>
            </div>
            <div style="margin-top: 10px;">
                <strong style="color: #2E7D32;">Estimated Delivery:</strong> <span style="color: #FFEB3B;">20 minutes</span>
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ url('order/'.$order_number) }}" class="btn btn-success" style="background-color: #388E3C; color: white; padding: 10px 20px; border: none; border-radius: 4px; text-decoration: none;">
                    View Order Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
