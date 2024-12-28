<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Sidebar Custom Styles */
    .sidebar {
        position: fixed;
        overflow: scroll;
      background-color: #28a745; /* Green */
      height: 100vh;
      padding-top: 20px;
    }
    .sidebar .nav-link {
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background-color: #218838;
    }
    .content {
      background-color:white; /* Yellow */
      padding: 20px;
      min-height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
        <div class="position-sticky">
            <h2 style="color:white">Subzi <span  style="color: yellow" >Store</span></h2>
          <ul class="nav flex-column">
            <li class="nav-item">
              <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#productsMenu" aria-expanded="false" aria-controls="productsMenu">
                <i class="fas fa-box"></i> Products
              </button>
              <div class="collapse" id="productsMenu">
                <ul class="nav flex-column ms-3">
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/products')}}">
                      <i class="fas fa-plus"></i>  Products
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/product/add')}}">
                      <i class="fas fa-list"></i>  Add Products
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#categoryMenu" aria-expanded="false" aria-controls="categoryMenu">
                  <i class="fas fa-th-large"></i> Categories
                </button>
                <div class="collapse" id="categoryMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('admin/category')}}">
                        <i class="fas fa-plus"></i> Category
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-list"></i> SubCategory
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-list"></i> ChildCategory
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

            <!-- Orders Section -->
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#orderMenu" aria-expanded="false" aria-controls="orderMenu">
                  <i class="fas fa-box"></i> Orders
                </button>
                <div class="collapse" id="orderMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-plus"></i> All Orders
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-hourglass-start"></i> Pending
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-check-circle"></i> Completed
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-times-circle"></i> Cancelled
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

            <!-- Tags Section -->
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#tagMenu" aria-expanded="false" aria-controls="tagMenu">
                  <i class="fas fa-tags"></i> Tags
                </button>
                <div class="collapse" id="tagMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-plus"></i> Add Tags
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-list"></i> Tags List
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

            <!-- Social Media Section -->
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#mediaMenu" aria-expanded="false" aria-controls="mediaMenu">
                  <i class="fas fa-share-alt"></i> Social Media
                </button>
                <div class="collapse" id="mediaMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-sync-alt"></i> Update Media
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

            <!-- Charges Section -->
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#chargeMenu" aria-expanded="false" aria-controls="chargeMenu">
                  <i class="fas fa-dollar-sign"></i> Charges
                </button>
                <div class="collapse" id="chargeMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-edit"></i> Update Charges
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

            <!-- Blogs Section -->
            <li class="nav-item mt-2">
                <button class="btn btn-dark w-100" data-bs-toggle="collapse" data-bs-target="#blogMenu" aria-expanded="false" aria-controls="blogMenu">
                  <i class="fas fa-blog"></i> Blogs
                </button>
                <div class="collapse" id="blogMenu">
                  <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-pencil-alt"></i> Add Blog
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <i class="fas fa-list"></i> Blog Categories
                      </a>
                    </li>
                  </ul>
                </div>
            </li>

          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-4 content">
        <!-- Yield Content Here -->
        @yield('content')
      </main>
    </div>
  </div>

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 5 JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
{{-- ck editor cdn here  --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

  <script>
    $(document).ready(function(){
        // Handle collapse toggle on button click
        $('[data-bs-toggle="collapse"]').click(function () {
            var target = $($(this).attr('data-bs-target'));
            setTimeout(() => {
                target.toggleClass('show');
            }, 1000);
            var expanded = target.hasClass('show');
            $(this).attr('aria-expanded', expanded);
        });
    });
  </script>
  <script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
  </script>
</body>
</html>
