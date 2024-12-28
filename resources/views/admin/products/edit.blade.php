@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-12">
        <h4 class="d-inline">Edit Product</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productform">
          @csrf
          @method('PUT')
          
          <!-- Product Name -->
          <div class="mb-3">
            <label class="form-label" for="productName">Product Name (Any Language)</label>
            <input class="form-control" id="productName" name="name" value="{{ $product->name }}" placeholder="Enter Product Name" type="text" required/>
          </div>

          <!-- Category, Subcategory, Child Category -->
          <div class="mb-3">
            <label class="form-label" for="category">Category</label>
            <select class="form-select" id="category" name="category_id">
              <option selected disabled>Select Category</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" for="subCategory">Sub Category</label>
            <select class="form-select" id="subCategory" name="subcategory_id">
              <option value="" selected>Select Sub Category</option>
              <!-- Dynamically populated subcategories -->
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" for="childCategory">Child Category</label>
            <select class="form-select" id="childCategory" name="childcategory_id">
              <option value="" selected>Select Child Category</option>
              <!-- Dynamically populated child categories -->
            </select>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label class="form-label" for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ $product->description }}</textarea>
          </div>

          <!-- Price -->
          <div class="mb-3">
            <label class="form-label" for="price">Price</label>
            <input class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Price" type="number" />
          </div>

          <!-- Tags -->
          <div class="mb-3">
            <label class="form-label" for="tags">Tags</label>
            <input class="form-control" id="tags" name="tags" value="{{ $product->tags }}" placeholder="Tags" type="text" />
          </div>

          <!-- Attributes -->
          <div class="mb-3">
            <label class="form-label">Attributes</label>
            <div id="attributesContainer">
              @foreach(json_decode($product->attributes, true) as $key => $value)
              <div class="row mb-2 attribute-row">
                <div class="col-md-5">
                  <input type="text" class="form-control" name="attributes[{{ $key }}][name]" value="{{ $key }}" placeholder="Attribute Name" required/>
                </div>
                <div class="col-md-5">
                  <input type="text" class="form-control" name="attributes[{{ $key }}][value]" value="{{ $value }}" placeholder="Attribute Value" required/>
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-danger remove-attribute">Remove</button>
                </div>
              </div>
              @endforeach
            </div>
            <button type="button" class="btn btn-secondary" id="addAttributeBtn">Add Attribute</button>
          </div>

          <!-- Meta Details -->
          <div class="mb-3">
            <label class="form-label" for="metaTitle">Meta Title</label>
            <input class="form-control" id="metaTitle" name="meta_title" value="{{ $product->meta_title }}" placeholder="Meta Title" type="text" />
          </div>

          <div class="mb-3">
            <label class="form-label" for="metaTag">Meta Tags</label>
            <input class="form-control" id="metaTag" name="meta_tags" value="{{ $product->meta_tags }}" placeholder="Meta Tags" type="text" />
          </div>

          <div class="mb-3">
            <label class="form-label" for="metaDesc">Meta Description</label>
            <input class="form-control" id="metaDesc" name="meta_desc" value="{{ $product->meta_description }}" placeholder="Meta Description" type="text" />
          </div>

          <!-- Thumbnail -->
          <div class="mb-3">
            <label class="form-label">Thumbnail Image</label>
            <input type="file" id="thumbnailImageInput" name="image" />
            @if($product->image)
            <img src="{{ asset($product->image) }}" alt="Thumbnail" class="img-thumbnail mt-2" width="100">
            @endif
          </div>

          <!-- Submit Button -->
          <button class="btn btn-primary" type="submit">Update Product</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    let attributeIndex = {{ count(json_decode($product->attributes, true)) ?? 0 }};

    $('#addAttributeBtn').click(function(e) {
      e.preventDefault();
      const attributeRow = `
        <div class="row mb-2 attribute-row">
          <div class="col-md-5">
            <input type="text" class="form-control" name="attributes[${attributeIndex}][name]" placeholder="Attribute Name" required/>
          </div>
          <div class="col-md-5">
            <input type="text" class="form-control" name="attributes[${attributeIndex}][value]" placeholder="Attribute Value" required/>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-attribute">Remove</button>
          </div>
        </div>`;
      $('#attributesContainer').append(attributeRow);
      attributeIndex++;
    });

    $(document).on('click', '.remove-attribute', function() {
      $(this).closest('.attribute-row').remove();
    });
  });
</script>
@endsection
