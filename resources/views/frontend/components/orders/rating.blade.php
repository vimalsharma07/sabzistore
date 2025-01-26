<style>
  .rating-stars i {
    font-size: 1.5rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s;
  }

  .rating-stars i.active {
    color: #ffc107;
  }

  .photo-upload-preview img {
    max-width: 100px;
    margin: 5px;
    border-radius: 5px;
  }
</style>

<div class="modal fade" id="rateOrderModal-{{ $order->id }}" tabindex="-1" aria-labelledby="rateOrderModalLabel-{{ $order->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rateOrderModalLabel-{{ $order->id }}">Rate Order #{{ $order->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="rateOrderForm-{{ $order->id }}" enctype="multipart/form-data">
          <!-- Hidden Input for Order ID -->
          <input type="hidden" name="order_id" value="{{ $order->id }}">

          <!-- Rating Section -->
          <div class="mb-3 text-center">
            <div class="rating-stars">
              <i class="bi bi-star-fill" data-value="1"></i>
              <i class="bi bi-star-fill" data-value="2"></i>
              <i class="bi bi-star-fill" data-value="3"></i>
              <i class="bi bi-star-fill" data-value="4"></i>
              <i class="bi bi-star-fill" data-value="5"></i>
            </div>
            <small class="text-muted">Tap a star to rate</small>
          </div>

          <!-- Feedback Text -->
          <div class="mb-3">
            <label for="feedbackText-{{ $order->id }}" class="form-label">Write Your Feedback</label>
            <textarea id="feedbackText-{{ $order->id }}" class="form-control" rows="3" name="feedback" placeholder="Share your experience..."></textarea>
          </div>

          <!-- Photo Upload -->
          <div class="mb-3">
            <label for="photoUpload-{{ $order->id }}" class="form-label">Add Photos</label>
            <input type="file" id="photoUpload-{{ $order->id }}" class="form-control" name="photos[]" multiple accept="image/*">
            <div class="photo-upload-preview mt-2 d-flex flex-wrap"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary submitReview" data-order-id="{{ $order->id }}">Submit Review</button>
      </div>
    </div>
  </div>
</div>

