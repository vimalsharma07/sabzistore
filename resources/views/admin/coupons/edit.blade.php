@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mt-3">Edit Coupon</h4>
    
    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Coupon Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $coupon->name) }}">
        </div>

        <div class="form-group">
            <label for="code">Coupon Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
        </div>
        <div class="form-group">
            <label for="code">Coupon Value</label>
            <input type="text" name="value" class="form-control" value="{{ old('value',$coupon->value) }}" required>
        </div>
        <div class="form-group">
            <label for="code">Min Order Value</label>
            <input type="text" name="min_value" class="form-control" value="{{ old('min_value',$coupon->min_value) }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Coupon Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $coupon->slug) }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $coupon->start_date) }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $coupon->end_date) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Coupon Type</label>
            <select name="type" class="form-control">
                <option value="p" {{ $coupon->type == 'p' ? 'selected' : '' }}>Percentage</option>
                <option value="r" {{ $coupon->type == 'r' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $coupon->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Coupon</button>
    </form>
</div>
@endsection
