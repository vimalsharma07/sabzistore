<!DOCTYPE html>
<html lang="en">
<head>
    <meta chaRs et="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet"> <!-- Added Noto Sans font -->
</head>
<body style="font-family: 'Noto Sans', Arial, sans-serif; margin: 0; padding: 0;">
    @php
      $user = Auth::user();
      $address = DB::table('address')->where('id', $order->address)->fiRst();
    @endphp
    <div style="margin: 20px;">
        <div style="background-color: #228B22; color: white; padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <div style="display: flex; justify-content: space-between;">
                <h1 style="margin: 0;">INVOICE</h1>
                <p style="margin: 0;">Order No: {{ $order->order_number }}</p>
            </div>
        </div>
        <div style="padding: 20px; border: 1px solid #ddd; border-top: none; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <h5 style="margin-bottom: 5px;">Bill To:</h5>
                    <p style="margin: 0;">{{ $user->name }}<br>{{ $user->phone }}<br> <b> {{$address->type}} </b> {{$address->houseno}}{{$address->appartment}} {{ $address->address }} </p>
                </div>
                <div style="text-align: right;">
                    <h5 style="margin-bottom: 5px;">From:</h5>
                    <p style="margin: 0;">SabziFarm<br>+91 9368311855<br>C-25 Sec-8 Noida Uttar Pradesh 201301</p>
                </div>
            </div>
            <p style="margin-top: 20px;">Date: {{ $order->created_at->format('d F Y') }}</p>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #FFD700;">
                        <th style="padding: 10px; border: 1px solid #ddd;">Description</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Qty</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = json_decode($order->products, true); // Decode JSON products
                    @endphp
                    @foreach($products as $index => $product)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $product['name'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $product['quantity'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rs {{ number_format($product['price'], 2) }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rs {{ number_format($product['price'] * $product['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: right; margin-top: 20px;">
                <p style="margin: 0; font-weight: bold;">Sub Total: Rs {{ number_format($order->grand_total, 2) }}</p>
                <p style="margin: 0; font-weight: bold;">Tip: Rs {{ number_format($order->tip, 2) }}</p>
                <p style="margin: 0; font-weight: bold;">Delivery Fee: Rs {{ number_format($order->delivery_fee, 2) }}</p>
                <p style="margin: 0; font-weight: bold;">Total Payable: Rs {{ number_format($order->total_pay, 2) }}</p>
            </div>
            <div style="margin-top: 20px;">
                <p>Note: {{ $order->coupon ? 'Coupon Applied: ' . $order->coupon : 'No additional notes' }}</p>
                <hr>
            </div>
        </div>
        <div style="padding: 20px; text-align: center;">
            <h2 style="margin: 0;">Thank You!</h2>
        </div>
    </div>
</body>
</html>
