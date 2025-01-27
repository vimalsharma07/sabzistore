@extends(getLayout())
@section('content')
    @php
        $user = Auth::user();
        $address = DB::table('address')->where('id', $order->address)->first();
    @endphp

    <div class="px-4 py-3 osahan-header-main">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="{{ url()->previous() }}"><i class="m-0 bi bi-arrow-left d-flex text-success h3 back-page"></i></a>
                <h3 class="m-0 fw-bold">Orders</h3>
            </div>

        </div>
    </div>

    <!-- Displaying Order Details -->


    <div class="p-4 mx-4 mb-3 bg-white shadow rounded-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="fw-bold fs-3">Your Order</div>
        </div>
        <hr>
        @php
            $products = json_decode($order->products, true);
        @endphp
        @foreach ($products as $product)
            <div class="m-0">
                <div class="gap-3 mb-3 d-flex align-items-center">
                    <img src="img/veg.jpg" alt="" class="img-fluid ch-20">
                    <div class="lh-sm">
                        <h4 class="mb-1">{{ $product['name'] ?? 'Unknown Product' }}</h4>
                        <div class="text-muted fw-normal">Quantity: {{ $product['quantity'] }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="gap-2 d-flex align-items-center fs-5">
                        <div>Price:</div>
                        <div>₹{{ number_format($product['price'], 2) }}</div>
                    </div>
                    <div class="fs-5 fw-bold">Total: &nbsp;₹{{ number_format($product['price'] * $product['quantity'], 2) }}
                    </div>
                </div>
            </div>
            <hr>
        @endforeach

        <!-- total price -->
        <div>
            <div class="mb-1 d-flex justify-content-between">
                <div>Items Total</div>
                {{-- show here total of Products --}}
                <div><del>$240</del>&nbsp;$204.50</div>
            </div>
            <div class="mb-1 d-flex justify-content-between">
                <div>Tip</div>
                <div>₹{{ number_format($order->tip, 2) }}</div>
            </div>
            <div class="mb-1 d-flex justify-content-between">
                <div>Delivery Charge</div>
                <div><del> ₹ {{ number_format($order->delivery_fee, 2) }} </del>
                    ₹{{ number_format($order->discounted_delivery_fee, 2) }}</div>
            </div>
            <div class="mb-1 d-flex justify-content-between">
                <div>Handling Fee</div>
                <div> <del>> ₹{{ number_format($order->handling_fee, 2) }} </del>
                    ₹{{ number_format($order->discounted_handling_fee, 2) }}</div>
            </div>
            @if ($order->discounted_small_cart_fee != 0)
                <div class="mb-1 d-flex justify-content-between">
                    <div>Small Cart Fee:</div>
                    <div> <del> ₹{{ number_format($order->small_cart_fee, 2) }} </del>
                        ₹{{ number_format($order->discounted_small_cart_fee, 2) }}</div>
                </div>
            @endif
            @if ($order->coupon_discounted != 0)
                <div class="mb-1 d-flex justify-content-between">
                    <div>Coupon</div>
                    <div>{{ $order->coupon ?? 'None' }}</div>
                </div>
                <div class="mb-1 d-flex justify-content-between">
                    <div>Coupon Discounted:</div>
                    <div> ₹{{ number_format($order->coupon_discounted, 2) }}</div>
                </div>
            @endif

            <!-- Grand total -->
            <div class="my-3 d-flex justify-content-between h3 fw-bold">
                <div>Grand Total</div>
                <div>₹{{ number_format($order->grand_total, 2) }}</div>
            </div>
            <!-- saving -->
            <div class="p-2 mb-0 rounded d-flex justify-content-between bg-danger-subtle border-primary text-danger h4">
                <div> Total Pay</div>
                <div>₹{{ number_format($order->total_pay, 2) }}</div>
            </div>
        </div>
    </div>


    <div class="p-4 mx-4 mb-3 bg-white shadow rounded-4">
        <!-- Order details -->
        <div>
            <h4 class="mb-3 fw-bold">Order Details</h4>
            <div class="">
                <div class="mb-0 text-muted text-uppercase small">order number</div>
                <div class="fs-5">{{ $order->order_number }}</div>
            </div>
            <div class="my-2">
                <div class="mb-0 text-muted text-uppercase small">Order Status</div>
                <div class="fs-5">{{ ucfirst($order->order_status) }}</div>
            </div>
            <div class="">
                <div class="mb-0 text-muted text-uppercase small">Date</div>
                <div class="fs-5">{{ $order->created_at }}</div>
            </div>
            <div class="my-2">
                <div class="mb-0 text-muted text-uppercase small">phone number</div>
                <div class="fs-5">8872306XXX</div>
            </div>
            <div>
                <div class="mb-0 text-muted text-uppercase small">Deliver to</div>
                <div class="fs-5">{{ $address->houseno }} {{ $address->appartment }} {{ $address->address }}</div>
            </div>
        </div>
        <hr>
    </div>


    <!-- Download Invoice Button -->
  
        <!-- First button: Download Invoice -->
        
        <div class="pt-2 pb-4">
            <div class="text-center d-grid">
                <form action="{{ route('orders.invoice', ['id' => $order->id]) }}" method="get">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill">Download Invoice</button>

                </form> 
            </div>
        </div>

        <!-- Second button: See Address on Map -->
        @if ($address->lat && $address->lang && $user->role == 'admin')
            <div class="mb-3 col-12 col-md-4">
                <button onclick="redirectonmap({{ $address->lat }}, {{ $address->lang }})" class="btn btn-primary w-100">
                    See Address on map
                </button>
            </div>
        @endif
        @include('frontend.components.orders.rating', ['order' => $order])
        <div class="mb-3 col-12 col-md-4">
            <button class="btn btn-primary w-100" data-bs-toggle="modal"
                data-bs-target="#rateOrderModal-{{ $order->id }}">
                Rate This Order
            </button>
        </div>
        <div class="pt-5 pb-5"></div>

    </div> 
@endsection
