@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Edit Store</h4>

    <form action="{{ route('stores.update', $store->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Method override for PUT request -->

        <div class="mb-3">
            <label for="name" class="form-label">Store Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $store->name }}" required />
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $store->address }}" required />
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $store->latitude }}" />
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $store->longitude }}" />
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $store->slug }}" />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $store->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $store->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Store</button>
    </form>
</div>
@endsection
