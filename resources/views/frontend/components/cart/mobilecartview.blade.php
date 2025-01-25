@extends(getLayout())
@section('content')
@php
    $emptycart = empty($cart);
@endphp
    <div class="osahan-header-main py-3 px-4">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="{{ url()->previous() }}"><i class="bi bi-arrow-left d-flex text-success h3 m-0 back-page"></i></a>
                <h3 class="fw-bold m-0">Cart</h3>
            </div>

        </div>
    </div>
    @if(!$emptycart)
    <div class="mx-4 mb-4 bg-white rounded-4 shadow overflow-hidden">
        <!-- body -->
        <div class="bg-white p-4 border-bottom">
            <div>
                @if (!empty($cart) && is_array($cart))
                    @foreach ($cart as $key => $item)
                        <!-- 1st -->
                        @php
                            $product = \App\Models\Product::find($item['product_id']);
                        @endphp
                        @if ($product)
                            <div class="mb-3 d-flex gap-3">
                                <img src="{{ $product->image_url }}" class="img-fluid mb-auto ch-20"
                                    alt="{{ $product->name }}">
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                                    <p class="mb-0">₹{{ array_values($item['attributes'])[0] }} <del
                                            class="strike-price">₹{{ $product->mrp }}</del></p>
                                    <p class="small text-muted m-0">1 Kgs</p>
                                </div>
                                <div class="ms-auto text-end cw-80">
                                    <div
                                        class="btn btn-white btn-sm border border-success px-2 rounded-pill overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <div class="minus decreaseQty" id="decreaseQty{{ $product->id }}"
                                                data-id="{{ $product->id }}"
                                                data-key="{{ array_key_first($item['attributes']) }}"
                                                data-value="{{ array_values($item['attributes'])[0] }}"><i
                                                    class="fa-solid fa-minus text-success"></i></div>
                                            <input class="shadow-none form-control text-center border-0 p-0 box"
                                                id="quantity{{ $product->id }}" data-id="{{ $product->id }}"
                                                value="{{ $item['quantity'] }}">
                                            <div class="plus increaseQty selected" id="increaseQty{{ $product->id }}"
                                                data-id="{{ $product->id }}"
                                                data-key="{{ array_key_first($item['attributes']) }}"
                                                data-value="{{ array_values($item['attributes'])[0] }}"><i
                                                    class="fa-solid fa-plus text-success"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>Product not found</div>
                        @endif
                    @endforeach
                @else
                    <p>Your cart is empty.</p>
                @endif

            </div>
            <hr>
        </div>
        <!-- Total price -->
        <div class="bg-white p-4 border-bottom">
            <h4>Bill Details</h4>
            <div class="d-flex justify-content-between">
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
                <div>Item Total</div>
                <div>₹{{ $fees['itemTotal'] }}</div>
            </div>
            <!-- accordion -->
            <div class="accordion">
                <div class="accordion-item bg-white border-0">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button
                            class="accordion-button px-0 pt-3 pb-3 bg-white border-0 shadow-none h5 mb-0 fw-normal text-dark"
                            type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                            aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Taxes & charges
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body px-0 pt-0">
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div>Delivery Charges for 3 Km</div>
                                <div><span class="text-danger"><del>₹{{ $fees['deliveryCharge']->fee }}</del></span>
                                    ₹{{ $fees['deliveryCharge']->discounted_fee }}</div>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div>Handling Charge</div>
                                <div><span
                                        class="text-danger"><del>₹{{ $fees['handlingCharge']->fee }}</del></span>₹{{ $fees['handlingCharge']->discounted_fee }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div>Small Order Charge</div>
                                <div><span class="text-danger"><del>₹{{ $fees['smallOrderCharge']->fee }}</del></span>
                                    ₹{{ $fees['smallOrderCharge']->discounted_fee }}</div>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div>Tip</div>
                                <div> ₹{{ $tip }}</div>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div><b>Grand Total</b></div>
                                <div><b><del> ₹{{ $fees['grandTotal'] }} </del> </b> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between h4 fw-bold m-0">
                <div>Payable Amount </div>
                <div>₹{{ $fees['discountedGrandTotal'] }}</div>
            </div>
        </div>
        <!-- Tip  -->
        <div class="bg-white p-4 border-bottom">
            <div class="mb-2">
                <h5 class="fw-bold mb-2">Please tip your delivery partner</h5>
                <p class="text-muted text-muted">Your kindness means a lot! 100% of your tip will go directly to your
                    delivery partner.
                </p>
            </div>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
                <button class="btn btn-outline-success btn-sm rounded-pill tip-btn" for="btnradio1" id="tip20">
                    <i class="bi bi-wallet me-1"></i>&nbsp;₹20
                </button>
                <div>
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" >
                <buttton class="btn btn-outline-success btn-sm rounded-pill  tip-btn" for="btnradio2" id="tip30">
                    <i class="bi bi-wallet me-1"></i>&nbsp;₹30
                </button>
            </div>
                <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                <label class="btn btn-outline-success btn-sm rounded-pill tip-btn" for="btnradio4" id="customtip">
                    <i class="bi bi-wallet me-1"></i>&nbsp;Custom Tip
                </label>

                

            </div>

            <div class="container mt-5 d-none" id="customTipBox">
                <div class="customtip-section" >
                    <input type="number" class="form-control" id="customtipvalue" placeholder="Enter tip" min="0">
                    <button class="btn px-3" id="customtipbtn">ADD</button>
                </div>
            </div>

            {{-- <div class="tip-buttons">
                <!-- Buttons for preset tips -->
                <button id="tip20" class="tip-btn">₹20</button>
                <button id="tip30" class="tip-btn">₹30</button>
                <button id="tip50" class="tip-btn">₹50</button>

                <!-- Button to show custom tip input box -->
                <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
            </div> --}}

        </div>
        <!-- Cancel policy -->
        <div class="bg-white p-4">

        </div>
    </div>
    <div class="pt-5 pb-4"></div>
    <div class="address-selection">
        {{-- <div class="cancellation-policy">
            <h5>Cancellation Policy</h5>
            <ul>
                <li>Order can be cancelled once placed for delivery. In case of unexpected delays, a refund will be
                    provided, if applicable.</li>
            </ul>
        </div> --}}

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

            <div class="fixed-bottom fixed-bottom-btn  p-4">
                <a data-bs-toggle="modal" data-bs-target="#otpModal" aria-expanded="false" class="btn btn-success btn-lg d-grid rounded-pill">
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div>Log In To procced</div>
                        <div><i class="fa-solid fa-caret-right"></i></div>
                    </div>
                </a>
            </div>
        @endif

    </div>
@else
<div class="container text-center my-5">
    <div class="card shadow-sm p-5">
      <div class="card-body">
        <i class="fas fa-shopping-cart text-secondary mb-4" style="font-size: 3rem;"></i>
        <h3 class="text-secondary mb-3">Your Cart is Empty</h3>
        <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
        <a href="/" class="btn btn-primary mt-3">
          <i class="fas fa-shopping-bag me-2"></i> Start Shopping
        </a>
      </div>
    </div>
  </div>
@endif

    <!-- Fixed bottom -->

@endsection
