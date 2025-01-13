@extends(getLayout())
@section('content')

    <div class="cart-layout">
        <div class="delivery-time">
            <i class="fas fa-clock"></i>
            <span>Delivery in 8 minutes</span>
        </div>

        @if (!empty($cart) && is_array($cart))
            @foreach ($cart as $key => $item)
                <div class="product">
                    <!-- Fetch product details dynamically using the product_id -->
                    @php
                        $product = \App\Models\Product::find($item['product_id']);
                    @endphp

                    @if ($product)
                        <div class="product-left">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            <div class="product-details">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-attribute">{{ array_key_first($item['attributes']) }}</div>
                                <div class="product-price">
                                    <!-- Normal price with strike-through and delivery free text -->
                                    <span class="normal-price">₹{{ array_values($item['attributes'])[0] }}</span>
                                    <span class="strike-price">₹{{ $product->mrp }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-right">
                            <div class="product-quantity">
                                <span id="decreaseQty{{ $product->id }}" class="decreaseQty" data-id="{{ $product->id }}"
                                    data-key="{{ array_key_first($item['attributes']) }}"
                                    data-value="{{ array_values($item['attributes'])[0] }}">-</span>
                                <span class="quantity-value" id="quantity{{ $product->id }}"
                                    data-id="{{ $product->id }}">{{ $item['quantity'] }}</span>
                                <span id="increaseQty{{ $product->id }}" class="increaseQty selected"
                                    data-id="{{ $product->id }}" data-key="{{ array_key_first($item['attributes']) }}"
                                    data-value="{{ array_values($item['attributes'])[0] }}">+</span>
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
                    $fees = getAllFees($itemTotal); // Fetch all fees
                @endphp

                <li><span>Item total</span><span>₹{{ $fees['itemTotal'] }}</span></li>
                <li><span> Delivery
                        Charge</span><span><del>₹{{ $fees['deliveryCharge']->fee }}</del>₹{{ $fees['deliveryCharge']->discounted_fee }}</span>
                </li>
                <li><span> Handling
                        Charge</span><span><del>₹{{ $fees['handlingCharge']->fee }}</del>₹{{ $fees['handlingCharge']->discounted_fee }}</span>
                </li>
                <li><span>Small Order
                        Charge</span><span><del>₹{{ $fees['smallOrderCharge']->fee }}</del>₹{{ $fees['smallOrderCharge']->discounted_fee }}</span>
                </li>
                <li><span>Tip</span><span>₹{{ $tip }}</span></li>

                <li><strong> Grand total</strong><strong> <del>₹{{ $fees['grandTotal'] }}</del></strong></li>

                <!-- Discounted Fee -->
                <li><strong>Payable Amount </strong><strong>₹{{ $fees['discountedGrandTotal'] }}</strong></li>
            </ul>
        </div>

        <!-- Tip Section -->
        <div class="tip">
            <h5>Tip Your Delivery Partner</h5>
            <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>

            <div class="tip-buttons">
                <!-- Buttons for preset tips -->
                <button id="tip20" class="tip-btn">₹20</button>
                <button id="tip30" class="tip-btn">₹30</button>
                <button id="tip50" class="tip-btn">₹50</button>

                <!-- Button to show custom tip input box -->
                <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
            </div>

            <!-- Custom Tip Input Box (Hidden initially) -->
            <div id="customTipBox d-none">
                <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input"
                    oninput="updateCustomTip()" />
                <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
            </div>
        </div>

        <div class="cancellation-policy">
            <h5>Cancellation Policy</h5>
            <ul>
                <li>Order can be cancelled once placed for delivery. In case of unexpected delays, a refund will be
                    provided, if applicable.</li>
            </ul>
        </div>

        <div class="address-selection">


            @if ($address != '')
                <div class="container mt-3">
                    <div class="delivery-info">
                        <img alt="House icon" src="https://placehold.co/24x24" />
                        <div class="address">
                            <p>
                                Delivering to
                                <span class="title">
                                    Home
                                </span>
                            </p>
                            <p>
                                {{ $address->houseno }} {{ $address->address }}
                            </p>

                        </div>
                        <div class="change">
                            Change
                        </div>
                    </div>
                    <div class="select-payment">
                        <a href="{{ url('/order/create') }}">
                            Place Order
                        </a>

                    </div>
                </div>
            @else
                <div>
                    <button class="btn btn-primart" data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false">
                        Log In To proccedd</button>
                </div>
            @endif

        </div>
    </div>
@endsection
