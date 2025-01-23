@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Story</h1>

    <form action="{{ route('stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $story->name }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $story->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $story->end_date }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select id="type" name="type" class="form-select" required>
                <option value="image" {{ $story->type === 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ $story->type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <input type="number" class="form-control" id="priority" name="priority" value="{{ $story->priority }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" {{ $story->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $story->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="files" class="form-label">Files</label>
            <input type="file" class="form-control" id="files" name="files">
           @foreach(json_decode($story->files) as $storyImg)
           <img  src="{{asset($storyImg)}}"  height="70"   width="100"  />
           @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Story</button>
    </form>
</div>
@endsection
