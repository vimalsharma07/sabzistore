@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-12">
        <h4 class="d-inline">Create Product</h4>
        <button class="btn btn-primary float-end">Back</button>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item"><a href="#">Add Product</a></li>
          </ol>
        </nav>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-8">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productform">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="productName">Product Name (Any Language)</label>
            <input class="form-control" id="productName" name="name" placeholder="Enter Product Name" type="text" required/>
          </div>
          
          <!-- Category, Subcategory, Child Category (dropdowns) -->
          <div class="mb-3">
            <label class="form-label" for="category">Category</label>
            <select class="form-select" id="category" name="category_id">
              <option selected="">Select Category</option>
              @foreach($categories as $key => $category)
              <option value="{{$category->id}}">{{$category->name}}</option>

              @endforeach
              <!-- Populate dynamically from the database -->
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" for="subCategory">Sub Category</label>
            <select class="form-select" id="subCategory" name="subcategory_id">
              <option  value="" selected>Select Sub Category</option>
              <!-- Populate dynamically from the database -->
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="childCategory">Child Category</label>
            <select class="form-select" id="childCategory" name="childcategory_id">
              <option selected  value="">Select Child Category</option>
              <!-- Populate dynamically from the database -->
            </select>
          </div>

          <!-- Other Fields -->
          <div class="mb-3">
            <label class="form-label" for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="metaTitle">Meta Title</label>
            <input class="form-control" id="metaTitle" name="meta_title" placeholder="Meta Title" type="text" />
          </div>

          <!-- Thumbnail Image (Hidden input to hold selected thumbnail image URL) -->
          <input type="file" id="thumbnailImageInput" name="image" />

          <!-- Submit Button -->
          <button class="btn btn-primary" type="submit">Save Product</button>
        </form>
      </div>

      <!-- Right Side: Gallery Section -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gallery</h5>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#galleryModal">
              Select Images
            </button>
            <div id="galleryPreview" class="mt-3">
              <!-- Selected images will be shown here -->
            </div>
            <div class="mb-3">
              <label class="form-label">Thumbnail Image</label>
              <div id="thumbnailPreview">
                <!-- Thumbnail image will be shown here -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for selecting multiple images -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="galleryModalLabel">Select Gallery Images</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input class="form-control" type="file" id="galleryImages" name="gallery_images[]" multiple accept="image/*"/>
            <div id="selectedImagesModal" class="mt-3">
              <!-- Preview of selected images within the modal -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addGalleryImages">Add Images</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Handle image selection and preview within the modal
      $('#galleryImages').change(function() {
        const files = this.files;
        $('#selectedImagesModal').empty(); // Clear previous previews

        $.each(files, function(index, file) {
          const imgPreview = $('<img>').attr('src', URL.createObjectURL(file)).addClass('img-thumbnail m-2').css({
            'max-width': '100px',
            'max-height': '100px'
          });
          $('#selectedImagesModal').append(imgPreview);
        });
      var images= document.getElementById('galleryImages');
      $('#productform').append(images);
        $('form #galleryImages').addClass('d-none');
      });

    //   // Add selected images to the gallery preview
    //   $('#addGalleryImages').click(function() {
    //     const files = $('#galleryImages')[0].files;
    //     $('#galleryPreview').empty(); // Clear previous preview
    //     $('#thumbnailPreview').empty(); // Clear previous thumbnail preview

    //     $.each(files, function(index, file) {
    //       const imgPreview = $('<img>').attr('src', URL.createObjectURL(file)).addClass('img-thumbnail m-2').css({
    //         'max-width': '100px',
    //         'max-height': '100px'
    //       });

    //       // Add image to gallery preview
    //       $('#galleryPreview').append(imgPreview);

    //       // Add image to thumbnail option
    //       const thumbnailOption = $('<div>').addClass('m-2');
    //       const thumbnailImg = $('<img>').attr('src', URL.createObjectURL(file)).addClass('img-thumbnail').css({
    //         'width': '50px',
    //         'height': '50px'
    //       });
    //       thumbnailOption.append(thumbnailImg);

    //       // Thumbnail click to show in thumbnail preview
    //       thumbnailOption.click(function() {
    //         $('#thumbnailPreview').empty(); // Clear previous preview
    //         const thumbnailLarge = $('<img>').attr('src', URL.createObjectURL(file)).css({
    //           'width': '150px',
    //           'height': '150px'
    //         });
    //         $('#thumbnailPreview').append(thumbnailLarge);

    //         // Set the hidden input to store the selected thumbnail image URL
    //         $('#thumbnailImageInput').val(URL.createObjectURL(file));
    //       });

    //       // Add thumbnail option below the gallery
    //       $('#galleryPreview').append(thumbnailOption);
    //     });

    //     // Close the modal after adding images
    //     $('#galleryModal').modal('hide');
    //   });
    });
  </script>
@endsection
