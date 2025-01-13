@extends(getLayout())

@section('content')
<div class="container">
    <h4>Edit Address</h4>

    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $address->type }}">
        </div>

        <div class="mb-3">
            <label for="houseno" class="form-label">House No</label>
            <input type="text" name="houseno" id="houseno" class="form-control" value="{{ $address->houseno }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control">{{ $address->address }}</textarea>
        </div>

        <div class="mb-3">
            <label for="landmark" class="form-label">Landmark</label>
            <input type="text" name="landmark" id="landmark" class="form-control" value="{{ $address->landmark }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
