<!-- resources/views/stories/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Stories</h1> 
    <a href="{{ url('/stories/create') }}">Add Story</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stories as $story)
                <tr>
                    <td>{{ $story->id }}</td>
                    <td>{{ $story->name }}</td>
                    <td>{{ ucfirst($story->type) }}</td>
                    <td>
                        <form action="{{ route('stories.update', $story->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="status" onchange="this.form.submit()" class="form-select">
                                <option value="active" {{ $story->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $story->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $story->priority }}</td>
                    <td>
                        <a href="{{ route('stories.edit', $story->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('stories.destroy', $story->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
