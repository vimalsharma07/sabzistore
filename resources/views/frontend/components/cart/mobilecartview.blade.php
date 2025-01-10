@extends(getLayout())
@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .cart-layout {
        background-color: #fff;
        padding: 20px;
        margin: 20px auto;
        border-radius: 12px;
        max-width: 600px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

    }

    .cart-layout .delivery-time, 
    .cart-layout .product, 
    .cart-layout .bill-details, 
    .cart-layout .donation, 
    .cart-layout .tip, 
    .cart-layout .cancellation-policy {
        margin-bottom: 20px;
    }

    .cart-layout .delivery-time i {
        color: #00b300;
        margin-right: 10px;
        font-size: 20px;
    }

    .cart-layout .product {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-layout .product img {
        height: 50px;
        border-radius: 5px;
    }

    .cart-layout .product-details div {
        font-size: 14px;
        color: #555;
    }

    .cart-layout .product-quantity {
        background-color: #00b300;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .cart-layout .bill-details h5, 
    .cart-layout .donation h5, 
    .cart-layout, 
    .cart-layout .cancellation-policy h5 {
        font-size: 16px;
        color: #333;
        margin-bottom: 10px;
    }

    .cart-layout .bill-details ul, 
    .cart-layout .donation ul, 
    .cart-layout .tip ul, 
    .cart-layout .cancellation-policy ul {
        list-style: none;
        padding: 0;
    }

    .cart-layout .bill-details li, 
    .cart-layout .donation li, 
    .cart-layout .tip li, 
    .cart-layout .cancellation-policy li {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .cart-layout .donation {
        background-color: #fff3cd;
        padding: 15px;
        border-radius: 5px;
    }

    .cart-layout .tip button {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        /*padding: 8px 15px;*/
        border-radius: 5px;
        font-size: 14px;
        margin-right: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .cart-layout .tip button:hover {
        background-color: #e9ecef;
        border-color: #ccc;
    }

    .cart-layout .address-selection {
        background-color: #00b300;
        color: #fff;
        text-align: center;
        padding: 15px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom:40px;
    }
    
    .product {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
}

.product-left {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 1;
}

.product-left img {
    height: 60px;
    border-radius: 5px;
}

.product-details {
    font-size: 14px;
    color: #555;
}

.product-details .product-name {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.product-details .product-attribute {
    margin-bottom: 5px;
}

.product-details .product-price {
    color: #007b00;
    font-weight: bold;
}

.product-right {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.product-quantity {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #f8f9fa;
    padding: 5px 10px;
    border-radius: 5px;
}

.product-quantity span {
    font-size: 16px;
    color: #333;
    cursor: pointer;
}

.product-quantity span.qty {
    margin: 0 8px;
    font-weight: bold;
}


    @media (max-width: 768px) {
        .cart-layout {
            padding: 15px;
            margin: 10px;
        }

        .cart-layout .product img {
            height: 40px;
        }

        .cart-layout .product-details div {
            font-size: 12px;
        }

        .cart-layout .product-quantity {
            padding: 4px 8px;
            font-size: 12px;
        }

        .cart-layout .bill-details li,
        .cart-layout .donation li,
        .cart-layout .tip li,
        .cart-layout .cancellation-policy li {
            font-size: 12px;
        }

        .cart-layout .tip button {
            /*padding: 6px 12px;*/
            font-size: 12px;
        }

        .cart-layout .address-selection {
            font-size: 12px;
            padding: 10px;
        }
        
    }
</style>
<div class="cart-layout">
    <div class="delivery-time">
        <i class="fas fa-clock"></i>
        <span>Delivery in 8 minutes</span>
    </div>

    @if(!empty($cart) && is_array($cart))
        @foreach($cart as $key => $item)
            <div class="product">
                <!-- Fetch product details dynamically using the product_id -->
                @php
                    $product = \App\Models\Product::find($item['product_id']);
                @endphp
                
                @if($product)
                    <div class="product-left">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        <div class="product-details">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-attribute">{{ array_key_first($item['attributes']) }}</div>
                            <div class="product-price">
                                <!-- Normal price with strike-through and delivery free text -->
                                <span class="normal-price">₹{{ array_values($item['attributes'])[0] }}</span>
                                <span class="strike-price">₹{{ $product->mrp }}</span> 
                                <span class="delivery-free">Delivery Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-right">
                        <div class="product-quantity">
                            <span class="decreaseqty">-</span>
                            <span class="qty">{{ $item['quantity'] }}</span>
                            <span class="increaseqty">+</span>
                        </div>
                    </div>
                @else
                    <div>Product not found</div>
                @endif
            </div>
        @endforeach
    @else
        <p>Your cart is empty.</p>
    @endif

    <div class="bill-details">
        <h5 class="bold">Bill Details</h5>
        <ul>
            <!-- Calculate normal and discounted prices using the helper function -->
            @php
                $itemTotal = 0;
                foreach ($cart as $item) {
                    $price = array_values($item['attributes'])[0] * $item['quantity'];
                    $itemTotal += $price;
                }

                // Get all fees (normal and discounted)
                    $fees = getAllFees($itemTotal);  // Fetch all fees
            @endphp

            <li><span>Item total</span><span>₹{{ $fees['itemTotal'] }}</span></li>
            <li><span> Delivery Charge</span><span><del>₹{{ $fees['deliveryCharge']->fee }}</del>₹{{ $fees['deliveryCharge']->discounted_fee }}</span></li>
            <li><span> Handling Charge</span><span><del>₹{{ $fees['handlingCharge']->fee }}</del>₹{{ $fees['handlingCharge']->discounted_fee }}</span></li>
            <li><span>Small Order Charge</span><span><del>₹{{ $fees['smallOrderCharge']->fee }}</del>₹{{ $fees['smallOrderCharge']->discounted_fee }}</span></li>
            <li><strong> Grand total</strong><strong> <del>₹{{ $fees['grandTotal'] }}</del></strong></li>

            <!-- Discounted Fee -->
            <!--<li><span>Delivery Free Charge</span><span>₹{{ $fees['discountedFee'] }}</span></li>-->
            <li><strong>Payable Amount  </strong><strong>₹{{ $fees['discountedGrandTotal'] }}</strong></li>
        </ul>
    </div>

    <!-- Tip Section -->
    <div class="tip">
        <h5>Tip Your Delivery Partner</h5>
        <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>
        
        <div class="tip-buttons">
            <!-- Buttons for preset tips -->
            <button id="tip20" class="tip-btn" onclick="selectTip(20)">₹20</button>
            <button id="tip30" class="tip-btn" onclick="selectTip(30)">₹30</button>
            <button id="tip50" class="tip-btn" onclick="selectTip(50)">₹50</button>

            <!-- Button to show custom tip input box -->
            <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
        </div>

        <!-- Custom Tip Input Box (Hidden initially) -->
        <div id="customTipBox" style="display:none;">
            <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input" oninput="updateCustomTip()" />
            <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
        </div>
    </div>

    <div class="cancellation-policy">
        <h5>Cancellation Policy</h5>
        <ul>
            <li>Order can be cancelled once placed for delivery. In case of unexpected delays, a refund will be provided, if applicable.</li>
        </ul>
    </div>

    <div class="address-selection"> 
        <a href="{{ url('/addaddress') }}">Please select an address</a>
    </div>
</div>
@endsection
@section('scripts')
<script>
    let selectedTip = 0; // Default selected tip value

    // jQuery: Function to highlight selected tip and update selectedTip
    function selectTip(amount) {
        selectedTip = amount;

        // Reset all buttons and highlight the selected one
        $('.tip-btn').css('background-color', '');
        $('#tip' + amount).css('background-color', 'green');

        // Hide custom tip input box if a preset tip is selected
        $('#customTipBox').hide();
        $('#customTip').val(''); // Clear custom tip input
    }

    // jQuery: Function to show the custom tip input box
    function showCustomTipInput() {
        $('#customTipBox').show();
        $('.tip-btn').css('background-color', ''); // Reset button colors
    }

    // jQuery: Function to handle custom tip input
    function updateCustomTip() {
        selectedTip = $('#customTip').val();
    }

    // jQuery: Function to add the custom tip to the selection
    function addCustomTip() {
        selectedTip = $('#customTip').val();

        // Highlight the custom tip button in green
        $('#customTipBtn').css('background-color', 'green');

        // Hide the custom input box
        $('#customTipBox').hide();
    }

    // jQuery: Save selected tip after page reload (if any tip was selected)
    $(document).ready(function() {
        if (selectedTip) {
            $('#customTipBtn').css('background-color', 'green');
        }
    });
</script>

<style>
    /* Strikethrough for normal price */
    .strike-price {
        text-decoration: line-through;
        color: #888;
        margin-left: 10px;
    }

    .delivery-free {
        color: green;
        font-weight: bold;
        margin-left: 10px;
    }

    /* Add some styling for the tip buttons and custom tip input */
    .tip-btn {
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
    }

    .tip-input {
        padding: 10px;
        margin-top: 5px;
    }

    .add-tip-btn {
        padding: 10px 20px;
        margin-top: 5px;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
    }

    .tip-buttons {
        margin-top: 10px;
    }
</style>



@endsection
