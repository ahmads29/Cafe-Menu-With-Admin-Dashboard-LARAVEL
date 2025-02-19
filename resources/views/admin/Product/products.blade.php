<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <title>Manage Items & Categories</title>
</head>
<body class="body">
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
                <h3 class="title">Manage Items </h3>
                <button class="add--button" id="addNewItem"><a href="{{route('products.create')}}" class="white-color"><i class="ri-add-circle-line"></i> Add New Product</a></button>
            </div>
            <div class="manage--content">
                <!-- Items Table -->
                <div class="table">
                    <div class="section--title">
                        <h3 class="title">Items</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Image</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Price</th>
                                <th width='50%'>Description</th>
                                <th width='15%'>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTable">
                            @foreach ($products as $product )
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->subsubcategory->subcategory->category->name }}</td>
                                    <td>{{ $product->subsubcategory->subcategory->name }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->description }}</td> <!-- Add this header for the description -->
                                    <td>
                                    <a href="{{ route('products.edit', $product->id) }}" >
                                        <button type="button" style="width: 75px" class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="width: 75px" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<!-- Add/Edit Item Modal -->
<div id="itemModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('itemModal')">&times;</span>
        <h2 id="itemModalTitle">Add/Edit Item</h2>
        <form id="itemForm" enctype="multipart/form-data">
            <input type="hidden" name="itemId" id="itemId">

            <label for="itemName">Item Name:</label>
            <input type="text" name="name" id="itemName" required>

            <label for="itemCategory">Category:</label>
            <select name="category_id" id="itemCategory" required></select>

            <label for="itemPriceLBP">Price (LBP):</label>
            <input type="number" name="price" id="itemPriceLBP" required min="0" step="1">

            <label for="itemDescription">Description (optional):</label>
            <textarea name="description" id="itemDescription" rows="3"></textarea>

            <label for="itemImage">Image (optional):</label>
            <input type="file" name="image" id="itemImage" accept="image/*">

            <button type="submit" id="saveItemBtn">Save Item</button>
        </form>
    </div>
</div>


<!-- Add/Edit Category Modal -->
<div id="categoryModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('categoryModal')">&times;</span>
        <h2 id="categoryModalTitle">Add/Edit Category</h2>
        <form id="categoryForm">
            <input type="hidden" id="categoryId"> <!-- Hidden input for categoryId (used when editing) -->

            <label for="categoryName">Category Name:</label>
            <input type="text" id="categoryName" required> <!-- Input for category name -->

            <label for="categoryIcon">Select Icon:</label>
            <select id="categoryIcon" onchange="updateIconPreview()"> <!-- Icon selection dropdown -->
                <option value="ri-cup-line">&#xf101; Cup</option>
                <option value="ri-cake-2-line">&#xf2b7; Cake</option>
                <option value="ri-restaurant-line">&#xf3a8; Restaurant</option>
                <option value="ri-apple-line">&#xf104; Apple</option>
                <option value="ri-coffee-line">&#xf239; Coffee</option>
                <option value="ri-basketball-line">&#xf3d1; Basketball</option>
                <option value="ri-bicycle-line">&#xf22d; Bicycle</option>
                <option value="ri-book-line">&#xf2c4; Book</option>
                <option value="ri-camera-line">&#xf2f1; Camera</option>
                <option value="ri-football-line">&#xf3cc; Football</option>
                <option value="ri-pizza-line">&#xf3d0; Pizza</option>
                <option value="ri-blaze-line">&#xf2b1; Shisha</option>
                <option value="ri-sugar-line">&#xe27c; Sweet</option> <!-- Sweet -->
                <option value="ri-store-2-line">&#xf02c; Market</option> <!-- Market -->
                <option value="ri-snack-line">&#xf2e6; Snack</option> <!-- Snack -->
                <option value="ri-bread-line">&#xf2c6; Bakery</option> <!-- Bakery -->
                <option value="ri-shopping-basket-2-line">&#xe27e; Shop</option> <!-- Shop -->
            </select>

            <!-- Icon preview -->
            <div>
                <span>Selected Icon:</span>
                <i id="iconPreview" class="ri-cup-line" style="font-size: 24px; margin-left: 8px;"></i> <!-- Default icon preview -->
            </div>

            <button type="submit" id="saveCategoryBtn">Save Category</button> <!-- Submit button -->
        </form>
    </div>
</div>


    <script src="assets/js/admin/main.js"></script>
    <style>


        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 100; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 90%; /* Could be more or less, depending on screen size */
            max-width: 600px; /* Maximum width */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h2 {
            margin: 0 0 15px 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%; /* Full width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px; /* Rounded corners */
            box-sizing: border-box; /* Include padding in width */
        }

        button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 200px; /* Full width */
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Icon preview style */
        #iconPreview {
            font-size: 24px; /* Size of the icon */
            margin-left: 8px; /* Space between text and icon */
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .modal-content {
                margin: 5% auto; /* Less margin for smaller screens */
            }

            h2 {
                font-size: 1.5em; /* Slightly smaller heading */
            }

            input[type="text"],
            input[type="number"],
            select,
            textarea {
                font-size: 14px; /* Smaller input fields */
            }

            button {
                font-size: 16px; /* Larger button text */
            }
        }
        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
    <script src="{{ asset('assets/js/admin/main.js')}}"></script>
</body>
</html>
