<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin/styles.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body>

    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>In</span> House</h2>
        </div>
        <div class="header--items">
            <div class="dark--theme--btn">
                <i class="ri-moon-line moon"></i>
                <i class="ri-sun-line sun"></i>
            </div>
        </div>
    </section>

    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href={{ route('admin') }}>
                        <span class="icon"><i class="ri-bar-chart-line"></i></span>
                        <div class="sidebar--item">Overview</div>
                    </a>
                </li>
                <li>
                    <a href={{ route('categories.index') }}>
                        <span class="icon"><i class="ri-handbag-line"></i></span>
                        <div class="sidebar--item">Category</div>
                    </a>

                </li>
                <li>
                    <a href={{ route('products.index') }} class="active">
                        <span class="icon"><i class="ri-handbag-line"></i></span>
                        <div class="sidebar--item">Product</div>
                    </a>

                </li>
                <li>
                    <a href={{ route('settings') }}>
                        <span class="icon"><i class="ri-settings-3-line"></i></span>
                        <div class="sidebar--item">Settings</div>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom--items">
                <li>
                    <a href={{ route('logout') }}>
                        <span class="icon"><i class="ri-logout-box-r-line"></i></span>
                        <div class="sidebar--item">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main--container">
            <div class="section--title">
                <h3 class="title">Add Product </h3>
            </div>
            <div class="manage--content">
                <!-- Items Table -->
                <div class="container mt-5">
                    <div class="card card-nohover">
                        <div class="container">
                            <!-- Form start, with Laravel route for product store -->
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf  <!-- Laravel CSRF token for security -->

                                <!-- Category Selection -->
                                <div class="row pb-3 pt-5 align-items-center">
                                    <div class="col-md-2">
                                        <label for="categorySelect" class="form-label">Category:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select id="categorySelect" name="category_id" class="form-control"  required aria-label="Product Category">
                                            <option value="" disabled    selected>Select a category</option>
                                            @foreach ($categories as $category )
                                                <option value={{$category->id}}  >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-3 pt-3 align-items-center">
                                    <div class="col-md-2">
                                        <label for="subCategorySelect" class="form-label">Sub Category:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select name="subcategory_id" id="subCategorySelect" class="form-control" >
                                            <option value="">Select SubCategory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-3 pt-3 align-items-center">
                                    <div class="col-md-2">
                                        <label for="subSubCategorySelect" class="form-label">Sub Sub Category:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select name="subsubcategory_id" id="subSubCategorySelect" class="form-control" >
                                            <option value="">Select SubSubCategory</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Name and Description -->
                                <div class="row pt-4 pb-3 align-items-center">
                                    <div class="col-md-2">
                                        <label for="NameInput" class="form-label">Name:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="NameInput" name="name" placeholder="Enter product name" required />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="PriceInput" class="form-label">Price:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="PriceInput" name="price"  placeholder="Enter product price" required />
                                    </div>
                                </div>

                                <!-- Product Price and Image Upload -->
                                <div class="row pt-4 pb-3 align-items-center">

                                    <div class="col-md-2">
                                        <label for="DescriptionInput" class="form-label">Description:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="DescriptionInput" name="description" placeholder="Enter product description" />
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pb-5 pt-4 text-center">
                                    <button type="submit" class="btn btn-primary btnAdd">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success', {
                closeButton: true,
                progressBar: true,
                timeOut: 3000 // Close after 3 seconds
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.success('{{ session('error') }}', 'Error', {
                closeButton: true,
                progressBar: true,
                timeOut: 3000 // Close after 3 seconds
            });
        </script>
    @endif --}}
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script>
    $(document).ready(function() {
        // Attach change event handler to the select element with id "categorySelect"
        $('#subCategorySelect').change(function() {
            var subCategoryId = $(this).val(); // Get the selected category ID
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/fetch-subsubcategory', // Replace with your endpoint URL
                method: 'post',
                data: {
                    subcategory_id: subCategoryId, // Send the selected category ID
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#subSubCategorySelect').empty();
                    $('#subSubCategorySelect').append('<option value="">Select SubCategory</option>');

                    // Populate the subcategory select element with fetched subcategories
                    if (response.data.length > 0) {
                        $.each(response.data, function(key, value) {
                            $('#subSubCategorySelect').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors
                }
            });
        });
    });
    $(document).ready(function() {
        // Attach change event handler to the select element with id "categorySelect"
        $('#categorySelect').change(function() {
            var categoryId = $(this).val(); // Get the selected category ID
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/fetch-subcategory', // Replace with your endpoint URL
                method: 'post',
                data: {
                    category_id: categoryId, // Send the selected category ID
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#subCategorySelect').empty();
                    $('#subCategorySelect').append('<option value="">Select SubSubCategory</option>');

                    // Populate the subcategory select element with fetched subcategories
                    if (response.data.length > 0) {
                        $.each(response.data, function(key, value) {
                            $('#subCategorySelect').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors
                }
            });
        });
    });
</script>
<script src="{{ asset('assets/js/admin/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
