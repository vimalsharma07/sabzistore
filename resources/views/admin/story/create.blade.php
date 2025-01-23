@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Create New Story</h2>
    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
       
            <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="Enter User ID"  value="{{Auth::user()->id}}">
        
        
        <div class="mb-3">
            <label for="name" class="form-label">Story Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Story Name" required>
        </div>
        
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
        </div>
        
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <input type="number" class="form-control" id="priority" name="priority" placeholder="Enter Priority (Higher values get more visibility)" required>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="files" class="form-label">Upload Files</label>
            <input type="file" class="form-control" id="files" name="files[]" multiple accept="image/*,video/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Story</button>
    </form>
</div>
@endsection
