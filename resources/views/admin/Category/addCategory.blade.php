<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <!-- Bootstrap CSS -->
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
                    <a href={{ route('categories.index') }} class="active">
                        <span class="icon"><i class="ri-handbag-line"></i></span>
                        <div class="sidebar--item">Category</div>
                    </a>

                </li>
                <li>
                    <a href={{ route('products.index') }} >
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
                <h3 class="title">Add Category </h3>
                {{-- <button class="add--button" id="addNewItem"><i class="ri-add-circle-line"></i> <a href="{{route(products.create)}}">Add New Item</a> </button> --}}
            </div>
            <div class="manage--content">
                <!-- Items Table -->
                <div class="container mt-5">
                    <div class="card card-nohover">
                        <div class="container">
                            <!-- Form start, with Laravel route for product store -->
                            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf  <!-- Laravel CSRF token for security -->

                                <!-- Category Selection -->
                                <div class="row pb-3 pt-5 align-items-center">
                                    <div class="col-md-2">
                                        <label for="categorySelect" class="form-label">Category:</label>
                                    </div>
                                    <div class="col-md-10">

                                        <input type="text" class="form-control" id="NameInput" name="name" placeholder="Enter category name" required />

                                    </div>
                                </div>
                                <div class="col-md-10 d-flex">
                                    <label for="ImageInput" class="form-label">Image:</label>
                                    <input class="pl-5" type="file" required class="form-control-file" id="ImageInput" name="icon" accept="image/*" />
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


<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="{{ asset('assets/js/admin/main.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
