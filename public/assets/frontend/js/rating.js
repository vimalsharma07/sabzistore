 $(document).ready(function () {
  // Handle star rating
  $(`#rateOrderModal-{{ $order->id }} .rating-stars i`).on('click', function () {
    const value = $(this).data('value');
    const stars = $(`#rateOrderModal-{{ $order->id }} .rating-stars i`);
    stars.removeClass('active');

    stars.each(function (index) {
      if (index < value) $(this).addClass('active');
    });

    // Update the hidden input for rating
    $(`#rateOrderForm-{{ $order->id }} input[name="rating"]`).remove();
    $(`<input>`, {
      type: 'hidden',
      name: 'rating',
      value: value
    }).appendTo(`#rateOrderForm-{{ $order->id }}`);
  });

  // Handle photo preview
  $(`#photoUpload-{{ $order->id }}`).on('change', function () {
    const preview = $(`#rateOrderModal-{{ $order->id }} .photo-upload-preview`);
    preview.empty(); // Clear previous previews

    Array.from(this.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = $('<img>', {
          src: e.target.result,
          class: 'img-thumbnail me-2',
          style: 'max-width: 100px; border-radius: 5px; margin-bottom: 5px;'
        });
        preview.append(img);
      };
      reader.readAsDataURL(file);
    });
  });

  // Handle submit review
  $(`#rateOrderModal-{{ $order->id }} .submitReview`).on('click', function (e) {
    e.preventDefault();

    const form = $(`#rateOrderForm-{{ $order->id }}`);
    const formData = new FormData(form[0]);

    $.ajax({
      url: '/order-review',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        alert(response.message);

        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.querySelector(`#rateOrderModal-{{ $order->id }}`));
        modal.hide();

        // Reload the page or dynamically update the UI
        location.reload();
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        alert('Failed to submit review. Please try again.');
      }
    });
  });
});

