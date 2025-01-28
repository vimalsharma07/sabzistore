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

        .order-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .order-header .status {
            display: flex;
            align-items: center;
        }

        .order-header .status i {
            margin-right: 5px;
        }

        .order-images img {
            width: 50px;
            height: 50px;
            margin-right: 5px;
            border-radius: 5px;
        }
    </style>

    <div class="container mt-4 bg-light">
        <div class="pb-3 m osahan-header-main">
            <div class="d-flex align-items-center">
                <div class="gap-3 d-flex align-items-center">
                    <a href="{{ url()->previous() }}"><i
                            class="m-0 bi bi-arrow-left d-flex text-success h3 back-page"></i></a>
                    <h3 class="m-0 fw-bold">Back</h3>
                </div>

            </div>
        </div>
        <h1 class="mb-4">My Orders</h1>
        <div id="ordersContainer">
            @if (isset($orders) && count($orders) > 0)
                @foreach ($orders as $order)
                    <div class="my-3 bg-white">
                        <div class="overflow-hidden border card rounded-4">
                            <div class="p-3 card-header border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="gap-2 d-flex">

                                        <div>
                                            <h5 class="mb-1">#{{ $order->order_number }}</h5>
                                            <p class="my-0 text-muted">{{ $order->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div
                                            class="badge bg-light mb-3 rounded-pill {{ $order->order_status === 'cancelled' ? 'text-danger' : 'text-success' }}">
                                            {{ $order->order_status }}</div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="gap-2 mb-3 d-flex align-items-center">
                                    @foreach (array_slice(json_decode($order->products, true), 0, 4) as $product)
                                        <div><img
                                                src="{{ url('/') }}/{{ $product['image'] ?? 'https://placehold.co/50x50' }}"
                                                alt="" class="img-fluid ch-20"></div>
                                    @endforeach
                                </div>

                                <hr>
                                <a href="#" class="text-decoration-none link-dark">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-muted">{{ $order->created_at }}</div>
                                    </div>
                                </a>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="text-muted">
                                        <a href="{{ url('/order/' . $order->order_number) }}"
                                            class="btn btn-danger btn-sm rounded-pill small"><i
                                                class="fas fa-eye"></i>&nbsp;View</a>
                                    </div>
                                    <div><a href="{{ url('/reorder/' . $order->order_number) }}"
                                            class="btn btn-danger btn-sm rounded-pill small"><i
                                                class="fa-solid fa-arrow-rotate-right"></i>&nbsp;Reorder</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- If no orders are passed, AJAX will fetch them -->
            @endif
        </div>


    </div>
@endsection

@section('scripts')
    @if (!isset($orders) || count($orders) === 0)
        <script>
            function fetchOrders() {
                $.ajax({
                    url: '/orders/',
                    method: 'GET',
                    success: function(orders) {
                        const ordersContainer = $('#ordersContainer');
                        ordersContainer.empty();

                        orders.forEach((order) => {
                            const statusClass = order.order_status === 'cancelled' ? 'text-danger' :
                                'text-success';
                            const statusIcon = order.order_status === 'cancelled' ? 'fa-times-circle' :
                                'fa-check-circle';
                            const productImages = JSON.parse(order.products).slice(0, 4).map(product =>
                                product.image || 'https://placehold.co/50x50');
                            const formattedImages = productImages.map(image =>
                                `<img src="{{ url('/') }}/${image}" alt="Product image" class="mb-3 img-fluid ch-40"/>`
                            ).join('');

                            const row = `
                        <div class="my-3 bg-white">
                        <div class="overflow-hidden border card rounded-4">
                            <div class="p-3 card-header border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="gap-2 d-flex">
                                        
                                        <div>
                                            <h5 class="mb-1">#${order.order_number}</h5>
                                            <p class="my-0 text-muted">
                                              ${order.created_at}</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div
                                            class="badge bg-white mb-3 rounded-pill status ${statusClass}">
                                            ${order.order_status}</div> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="gap-2 mb-3 d-flex align-items-center">
                                 ${formattedImages}
                                </div>
                                <hr>
                                <a href="#" class="text-decoration-none link-dark">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-muted">${order.created_at}</div>
                                    </div>
                                </a>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="text-muted">
                                        <a href="{{ url('/order/${order.order_number}') }}"
                                            class="btn btn-danger btn-sm rounded-pill small"><i
                                                class="fas fa-eye"></i>&nbsp;View</a>
                                    </div>
                                    <div><a href="{{ url('/reorder/${order.order_number}') }}"
                                            class="btn btn-danger btn-sm rounded-pill small"><i
                                                class="fa-solid fa-arrow-rotate-right"></i>&nbsp;Reorder</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                            ordersContainer.append(row);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching orders:', error);
                    }
                });
            }

            $(document).ready(fetchOrders);
        </script>
    @endif
@endsection
