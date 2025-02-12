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

<div class="container mt-4">
    <h1 class="mb-4">My Orders</h1>
    <div id="ordersContainer">
        @if(isset($orders) && count($orders) > 0)
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="status {{ $order->order_status === 'cancelled' ? 'text-danger' : 'text-success' }}">
                            <i class="fas {{ $order->order_status === 'cancelled' ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                            <span>{{ $order->order_status }}</span>
                        </div>
                        <div class="order-time text-muted">
                            #{{ $order->order_number }} - {{ $order->created_at }}
                        </div>
                    </div>
                    <div class="order-images mt-2">
                        @foreach(array_slice(json_decode($order->products, true), 0, 4) as $product)
                            <img src="{{ url('/') }}/{{ $product['image'] ?? 'https://placehold.co/50x50' }}" alt="Product image" class="img-fluid mb-3">
                        @endforeach
                    </div>
                    <div class="order-actions mt-3 d-flex justify-content-between">
                        <a href="{{ url('/reorder/' . $order->order_number) }}" class="btn btn-primary btn-sm">Reorder</a>
                        <a href="{{ url('/order/' . $order->order_number) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
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
@if(!isset($orders) || count($orders) === 0)
<script>
    function fetchOrders() {
        $.ajax({
            url: '/orders/',
            method: 'GET',
            success: function(orders) {
                const ordersContainer = $('#ordersContainer');
                ordersContainer.empty();

                orders.forEach((order) => {
                    const statusClass = order.order_status === 'cancelled' ? 'text-danger' : 'text-success';
                    const statusIcon = order.order_status === 'cancelled' ? 'fa-times-circle' : 'fa-check-circle';
                    const productImages = JSON.parse(order.products).slice(0, 4).map(product => product.image || 'https://placehold.co/50x50');
                    const formattedImages = productImages.map(image => `<img src="{{ url('/') }}/${image}" alt="Product image" class="img-fluid mb-3"/>`).join('');

                    const row = `
                        <div class="order-card">
                            <div class="order-header">
                                <div class="status ${statusClass}">
                                    <i class="fas ${statusIcon}"></i>
                                    <span>${order.order_status}</span>
                                </div>
                                <div class="order-time text-muted">
                                    #${order.order_number} - ${order.created_at}
                                </div>
                            </div>
                            <div class="order-images mt-2">
                                ${formattedImages}
                            </div>
                           <div class="order-actions mt-3 d-flex justify-content-between">
                                <a href="{{ url('/reorder/${order.order_number}') }}" class="btn btn-primary btn-sm">Reorder</a>
                                <a href="{{ url('/order/${order.order_number}') }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
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
