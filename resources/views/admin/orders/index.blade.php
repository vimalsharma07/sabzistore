@extends('layouts.admin')

@section('content')
<table id="ordersTable" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order Number</th>
            <th>User ID</th>
            <th>Grand Total</th>
            <th>Order Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->grand_total }}</td>
            <td>{{ $order->order_status }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
                <button type="button" class="btn btn-primary update-status" data-id="{{ $order->id }}" data-status="{{ $order->order_status }}">Update Status</button>
                <a href="{{url('admin/order/'.$order->order_number)}}" class="btn btn-primary" data-id="{{ $order->id }}" data-status="{{ $order->order_status }}"> <i class="fas fa-eye"></i> </a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStatusForm" method="POST" action="{{ route('updateOrderStatus') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="mb-3">
                        <label for="order_status" class="form-label">Order Status</label>
                        <select class="form-select" id="order_status" name="order_status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
    $('#ordersTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5',
            'print'
        ]
    });
});


$(document).on('click', '.update-status', function() {
    const orderId = $(this).data('id');
    const currentStatus = $(this).data('status');
    $('#order_id').val(orderId);
    $('#order_status').val(currentStatus);
    $('#updateStatusModal').modal('show');
});

</script>
@endsection
