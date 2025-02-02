@extends(getLayout())

@section('content')
    <style>
        .order-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #fff;
        }
    </style>

    <div class="container mt-4 bg-light">
        <div class="pb-3 osahan-header-main">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url()->previous() }}"><i class="m-0 bi bi-arrow-left d-flex text-success h3 back-page"></i></a>
                <h3 class="m-0 fw-bold">Back</h3>
            </div>
        </div>
        
        <h1 class="mb-4">My Orders</h1>
        
        <div id="ordersContainer">
            @if ($orders->isNotEmpty())
                @foreach ($orders as $order)
                    <div class="my-3 bg-white">
                        <div class="overflow-hidden border card rounded-4">
                            <div class="p-3 card-header border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-1">#{{ $order->order_number }}</h5>
                                        <p class="my-0 text-muted">{{ $order->created_at->format('d-M-Y H:i') }}</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-light rounded-pill {{ $order->order_status === 'cancelled' ? 'text-danger' : 'text-success' }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex gap-2 mb-3">
                                    @foreach (array_slice(json_decode($order->products, true), 0, 4) as $product)
                                        <img src="{{ url($product['image'] ?? 'https://placehold.co/50x50') }}" alt="Product image" class="img-fluid ch-40">
                                    @endforeach
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="text-muted">{{ $order->created_at->format('d-M-Y') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ url('/order/' . $order->order_number) }}" class="btn btn-danger btn-sm rounded-pill">
                                        <i class="fas fa-eye"></i>&nbsp;View
                                    </a>
                                    <a href="{{ url('/reorder/' . $order->order_number) }}" class="btn btn-danger btn-sm rounded-pill">
                                        <i class="fa-solid fa-arrow-rotate-right"></i>&nbsp;Reorder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted text-center">No orders found.</p>
            @endif
        </div>
    </div>
@endsection
