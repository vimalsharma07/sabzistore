
  
  <style>
   .cart-container {
            position: fixed;
            bottom: 100px;
            right: 20px;
            background-color: #28a745;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-images {
            display: flex;
            margin-right: 10px;
        }
        .cart-images img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: -10px;
            border: 2px solid white;
        }
        .cart-text {
            margin-right: 10px;
        }
        .cart-text h5 {
            margin: 0;
            font-size: 16px;
        }
        .cart-text p {
            margin: 0;
            font-size: 12px;
        }
        .cart-arrow {
            font-size: 20px;
        }
  </style>
 </head>
 <body>
    @php
    $cart = session('cart', []); 

$itemTotal = 0;
$totalqty=0;
foreach ($cart as $item) {
    $price = array_values($item['attributes'])[0] * $item['quantity'];
    $itemTotal += $price;
    $totalqty++;
}

@endphp
<div id="mobilesmallcartview">
@if($totalqty!=0)
  <a class="cart-container " href="{{url('/cart')}}" >
   <div class="cart-images">
    @foreach ($cart as $item) 
    <?php  
     $product=   DB::table('products')->where('id', $item['product_id'])->first();
    ?>
    <img alt="Product 1 image" height="30" src="{{ asset($product->image) }}" width="30"/>
    @endforeach
   
   </div>
   <div class="cart-text">
    <h5>
     View cart
    </h5>
    <p>
     {{$totalqty}} ITEMS
    </p>
   </div>
   <div class="cart-arrow">
    <i class="fas fa-chevron-right">
    </i>
   </div>
  </a>
  @endif
</div>
 
