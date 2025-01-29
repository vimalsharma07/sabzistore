@extends(getLayout())
@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Your Reviews</h1>
<!-- Check for success message -->
@include('frontend.components.success.success-error')

    @foreach($reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <!-- Display user avatar (if exists) -->
                    <img src="{{ $review->user->photo ?? 'https://via.placeholder.com/50' }}" alt="User Avatar" class="rounded-circle me-3" width="50" height="50">
                    <div>
                        <h5 class="card-title">{{ $review->user->name }}</h5>
                        <p class="card-text text-muted">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="rating mb-2">
                    <!-- Display Rating (Stars) -->
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
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
    @endforeach
</div>
@endsection
