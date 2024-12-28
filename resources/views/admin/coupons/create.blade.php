@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mt-3">Create New Coupon</h4>
    
    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Coupon Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="code">Coupon Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
        </div>
        <div class="form-group">
            <label for="code">Coupon Value</label>
            <input type="text" name="value" class="form-control" value="{{ old('value') }}" required>
        </div>
        <div class="form-group">
            <label for="code">Min Order Value</label>
            <input type="text" name="min_value" class="form-control" value="{{ old('value') }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Coupon Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
        </div>

        <div class="form-group">
            <label for="type">Coupon Type</label>
            <select name="type" class="form-control">
                <option value="p" {{ old('type') == 'p' ? 'selected' : '' }}>Percentage</option>
                <option value="r" {{ old('type') == 'r' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="brands">Brands (Optional)</label>
            <input type="text" name="brands" class="form-control" value="{{ old('brands') }}">
        </div>

        <div class="form-group">
            <label for="products">Products (Optional)</label>
            <input type="text" name="products" class="form-control" value="{{ old('products') }}">
        </div>

        <div class="form-group">
            <label for="users">Users (Optional)</label>
            <input type="text" name="users" class="form-control" value="{{ old('users') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Coupon</button>
    </form>
</div>
@endsection
