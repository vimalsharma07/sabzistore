@extends('layouts.admin')
@section('content')
<div class="container">
    <h1 class="my-4">Update Media</h1>
    <form action="{{ route('media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo">
            @if($media->logo)
                <img src="{{asset($media->logo)}}" alt="Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $media->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="whatsapp" class="form-label">WhatsApp</label>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $media->whatsapp) }}">
        </div>

        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $media->facebook) }}">
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $media->instagram) }}">
        </div>

        <div class="mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $media->twitter) }}">
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $media->mobile) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Media</button>
    </form>
</div>
@endsection
