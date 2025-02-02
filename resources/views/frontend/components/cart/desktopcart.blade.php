@php
    $user = Auth::user();
    $address = '';
    if ($user) {
        $address = DB::table('address')->where('default', 1)->where('user_id', $user->id)->first();
    }
@endphp


{{-- <div class=" offcanvas offcanvas-end my-cart-width" id="mycart">
    <div class="delivery-time">
        <i class="fas fa-clock"></i>
        <span>Delivery in 8 minutes</span>
        <span id="overlay" class="btn btn-close"></span>
    </div>

    @if (!empty($cart) && is_array($cart))
        @foreach ($cart as $key => $item)
            <div class="product">
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
            @php
                $itemTotal = 0;
                $totalqty = 0;
                foreach ($cart as $item) {
                    $price = array_values($item['attributes'])[0] * $item['quantity'];
                    $itemTotal += $price;
                    $totalqty++;
                }
                $fees = getAllFees($itemTotal);
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
            @if (isset($tip))
                <li><span>Tip</span><span>₹{{ $tip }}</span></li>
            @endif

            <li><strong> Grand total</strong><strong> <del>₹{{ $fees['grandTotal'] }}</del></strong></li>
            <li><strong>Payable Amount </strong><strong>₹{{ $fees['discountedGrandTotal'] }}</strong></li>
        </ul>
    </div>

    <div class="tip">
        <h5>Tip Your Delivery Partner</h5>
        <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>

        <div class="tip-buttons">
            <button id="tip20" class="tip-btn" onclick="selectTip(20)">₹20</button>
            <button id="tip30" class="tip-btn" onclick="selectTip(30)">₹30</button>
            <button id="tip50" class="tip-btn" onclick="selectTip(50)">₹50</button>
            <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
        </div>

        <div id="customTipBox" style="display:none;">
            <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input"
                oninput="updateCustomTip()" />
            <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
        </div>
    </div>
    <div class="address-selection">
        {{-- <div class="cancellation-policy">
        <h5>Cancellation Policy</h5>
        <ul>
            <li>Order can be cancelled once placed for delivery. In case of unexpected delays, a refund will be
                provided, if applicable.</li>
        </ul>
    </div> --}}

{{-- @if ($address != '')
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

    </div> --}}


{{-- </div> --}}

<!-- My Cart Offcanvas -->
<div class="offcanvas offcanvas-end my-cart-width" tabindex="-1" id="mycart">
    <div class="px-4 py-3 offcanvas-header">
        <h5 class="offcanvas-title fw-bold">My Cart</h5>
        <button type="button" class="shadow-none btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="p-0 offcanvas-body">
        <div class="px-4 py-3 bg-light">
            <h6 class="mb-1 fw-bold">Delivery in 10 minutes</h6>
        </div>
        <!-- 1st product -->
        @if (!empty($cart) && is_array($cart))
            @foreach ($cart as $key => $item)
                @php
                    $product = \App\Models\Product::find($item['product_id']);
                @endphp

                @if ($product)
                    <div class="px-4 py-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ $product->image_url }}" alt="" class="border img-fluid rounded-4">
                            </div>
                            <div class="col-9">
                                <h6 class="mb-1 fw-bold">{{ $product->name }}</h6>
                                <p class="text-muted">{{ array_key_first($item['attributes']) }}</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 fw-bold"><del
                                            class="text-muted small fw-normal">₹{{ $product->mrp }}</del><br>₹{{ array_values($item['attributes'])[0] }}
                                    </h6>
                                    <div class="overflow-hidden border rounded input-group value">
                                        <input type="button" value="-"
                                            class="button-minus btn btn-light btn-sm border-end col decreaseQty"
                                            id="decreaseQty{{ $product->id }}" data-field="quantity"
                                            data-id="{{ $product->id }}"
                                            data-key="{{ array_key_first($item['attributes']) }}"
                                            data-value="{{ array_values($item['attributes'])[0] }}">
                                        <input type="text" value="{{ $item['quantity'] }}" name="quantity"
                                            class="text-center border-0 shadow-none quantity-field form-control form-control-sm col"
                                            id="quantity{{ $product->id }}" data-id="{{ $product->id }}">
                                        <input type="button" id="increaseQty{{ $product->id }}" value="+"
                                            class="button-plus btn btn-light btn-sm border-start col increaseQty selected"
                                            data-field="quantity" data-id="{{ $product->id }}"
                                            data-key="{{ array_key_first($item['attributes']) }}"
                                            data-value="{{ array_values($item['attributes'])[0] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif


        <div class="p-4 bg-light">
            @php
                $itemTotal = 0;
                $totalqty = 0;
                foreach ($cart as $item) {
                    $price = array_values($item['attributes'])[0] * $item['quantity'];
                    $itemTotal += $price;
                    $totalqty++;
                }
                $fees = getAllFees($itemTotal);
            @endphp
            <div class="mb-1 d-flex align-items-center justify-content-between">
                <p class="m-0 text-muted">Item Total</p>
                <p class="m-0">₹{{ $fees['itemTotal'] }}</p>
            </div>
            <div class="mb-1 d-flex align-items-center justify-content-between">
                <p class="m-0 text-muted">Delivery Charges</p>
                <p class="m-0">
                    <del>₹{{ $fees['deliveryCharge']->fee }}</del>₹{{ $fees['deliveryCharge']->discounted_fee }}
                </p>
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <p class="m-0 text-muted">Handling
                    Charge</p>
                <p class="m-0 text-info">
                    <del>₹{{ $fees['handlingCharge']->fee }}</del>₹{{ $fees['handlingCharge']->discounted_fee }}
                </p>
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <p class="m-0 text-muted">Small Order Charge</p>
                <p class="m-0 text-info">
                    <del>₹{{ $fees['smallOrderCharge']->fee }}</del>₹{{ $fees['smallOrderCharge']->discounted_fee }}
                </p>
            </div>
            @if (isset($tip))
                <div class="mb-3 d-flex align-items-center justify-content-between">
                    <p class="m-0 text-muted">Tip</p>
                    <p class="m-0 text-info">₹{{ $tip }}</p>
                </div>
            @endif
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Grand Total</h6>
                <p class="m-0 fw-bold text-danger"><del>₹{{ $fees['grandTotal'] }}</del></strong></p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Payable Amount</h6>
                <p class="m-0 fw-bold text-danger">₹{{ $fees['discountedGrandTotal'] }}</del></strong></p>
            </div>
        </div>

        <div class="p-4 tip">
            <h5>Tip Your Delivery Partner</h5>
            <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>

            <div class="tip-buttons">
                <button id="tip20" class="tip-btn" onclick="selectTip(20)">₹20</button>
                <button id="tip30" class="tip-btn" onclick="selectTip(30)">₹30</button>
                <button id="tip50" class="tip-btn" onclick="selectTip(50)">₹50</button>
                <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
            </div>

            <div id="customTipBox" style="display:none;">
                <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input"
                    oninput="updateCustomTip()" />
                <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
            </div>
        </div>
    </div>


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

            <div class="p-4 offcanvas-footer">
                <a href="{{ url('/order/create') }}"
                    class="px-4 py-3 shadow btn btn-danger fw-bold d-flex align-items-center justify-content-between w-100 rounded-4">
                    Place Order
                    <span class="text-uppercase">Proceed<i class="icofont-double-right ms-1"></i></span>
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
