@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-12">
        <h4 class="d-inline">Create Product</h4>
        
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
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
            <label class="form-label" for="price"> Price </label>
            <input class="form-control" id="price" name="price" placeholder="price" type="number" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="mrp"> Mrp </label>
            <input class="form-control" id="mrp" name="mrp" placeholder="mrp" type="number" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="metaTitle"> #Tags </label>
            <input class="form-control" id="metaTitle" name="tags" placeholder="tags" type="text" />
          </div>
          <div class="mb-3">
            <label class="form-label">Attributes</label>
            <div id="attributesContainer">
            </div>
            <button type="button" class="btn btn-secondary" id="addAttributeBtn">Add Attribute</button>
          </div>
          <div class="mb-3">
            <label class="form-label" for="metaTitle">Meta Title</label>
            <input class="form-control" id="metaTitle" name="meta_title" placeholder="Meta Title" type="text" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="metaTitle">Meta Tags</label>
            <input class="form-control" id="metaTitle" name="meta_tag" placeholder="Meta Tags" type="text" />
          </div>

          <div class="mb-3">
            <label class="form-label" for="metaTitle">Meta Description</label>
            <input class="form-control" id="metaTitle" name="meta_desc" placeholder="Meta Desc" type="text" />
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
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
  <!-- jQuery Script -->
  @section('scripts')
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

    
    });
  </script>
  <script>
    $(document).ready(function() {
      let attributeIndex = 0; // To track the index of attributes

      // Add Attribute
      $('#addAttributeBtn').click(function(e) {
        e.preventDefault();
        const attributeRow = `
          <div class="row mb-2 attribute-row" data-index="${attributeIndex}">
            <div class="col-md-3">
              <input type="text" class="form-control" name="attributes[${attributeIndex}][name]" placeholder="Attribute Name" required/>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" name="attributes[${attributeIndex}][value]" placeholder="Attribute Value" required/>
            </div>
            <div class="col-md-3">
            <input type="number" class="form-control" name="mrps[${attributeIndex}]" placeholder="MRP" required/>
          </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-danger remove-attribute">Remove</button>
            </div>
          </div>`;
        $('#attributesContainer').append(attributeRow);
        attributeIndex++;
      });

      // Remove Attribute Row
      $(document).on('click', '.remove-attribute', function() {
        $(this).closest('.attribute-row').remove();
      });
    });
  </script>
@endsection
