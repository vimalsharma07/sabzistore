@extends(getLayout())
@section('content')

<div class="container mt-4">
    <div class="pb-3 m osahan-header-main">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="{{ url()->previous() }}"><i
                        class="m-0 bi bi-arrow-left d-flex text-success h3 back-page"></i></a>
                <h3 class="m-0 fw-bold">Back</h3>
            </div>

        </div>
    </div>
    
    <h4 class="mb-3">My Address</h4>
    
    @if($addresses->isNotEmpty())
        <div class="list-group">
            @foreach($addresses as $address)
            <div class="p-3 mb-3 border rounded address-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ ucfirst($address->type ?? 'Address') }}</h5>
                        <p class="mb-1">
                            {{ $address->houseno }},
                            @if($address->appartment)
                                {{ $address->appartment }},
                            @endif
                            {{ $address->address }}
                        </p>
                        @if($address->landmark)
                        <small class="text-muted">Landmark: {{ $address->landmark }}</small><br>
                        @endif
                        <small class="text-muted">Lat: {{ $address->lat }}, Long: {{ $address->lang }}</small>
                    </div>
                    <div>
                        @if($address->default)
                        <span class="badge bg-success">Default</span>
                        @endif
                        <a href="{{ url('/addresses/edit', $address->id) }}" class="btn btn-sm btn-link text-primary">Edit</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('addresses.delete', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
            </form>
            
            @endforeach
        </div>
    @else
        <p class="text-center">No addresses found. <a href="{{ url('/addresses/create') }}">Add a new address</a></p>
    @endif
</div>
@endsection
