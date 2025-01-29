@extends(getLayout())
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="rating mb-2">
                    <!-- Display Rating (Stars) -->
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                </div>
                <!-- Delete Button -->
                <form action="{{ route('reviews.delete', $review->id) }}" method="POST" class="ms-auto" id="deleteReviewForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Review" id="deleteButton">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
            
            <p class="card-text">{{ $review->feedback ?? 'No feedback provided.' }}</p>

            <!-- Display Photos (if any) -->
            @if($review->photos)
                <div class="photo-gallery mt-3">
                    @foreach(json_decode($review->photos) as $photo)
                        <img src="{{ asset($photo) }}" alt="Review Photo" class="img-thumbnail" style="max-width: 100px; margin: 5px;">
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // JavaScript Confirmation on Delete
    document.getElementById('deleteButton').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent the form from submitting immediately
        const confirmed = confirm("Are you sure you want to delete this review? This action cannot be undone.");
        
        if (confirmed) {
            // If confirmed, submit the form
            document.getElementById('deleteReviewForm').submit();
        }
    });
</script>
@endsection
