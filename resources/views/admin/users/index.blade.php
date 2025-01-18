@extends('layouts.admin')

@section('content')
<table id="usersTable" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->gender) }}</td>
            <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <button type="button" class="btn btn-primary update-user" 
                        data-id="{{ $user->id }}" 
                        data-name="{{ $user->name }}" 
                        data-status="{{ $user->status }}" 
                        data-role="{{ $user->role }}">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" method="POST" action="{{ route('updateUser') }}">
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="user_name" name="name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="user_status" class="form-label">Status</label>
                        <select class="form-select" id="user_status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_role" class="form-label">Role</label>
                        <select class="form-select" id="user_role" name="role" required>
                            <option value="user">User</option>
                            <option value="vendor">Vendor</option>
                            <option value="admin">Admin</option>
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
    $('#usersTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
    });
        });



        $(document).on('click', '.update-user', function() {
    const userId = $(this).data('id');
    const userName = $(this).data('name');
    const userStatus = $(this).data('status');
    const userRole = $(this).data('role');

    $('#user_id').val(userId);
    $('#user_name').val(userName);
    $('#user_status').val(userStatus);
    $('#user_role').val(userRole);
    $('#updateUserModal').modal('show');
});

</script>
@endsection
