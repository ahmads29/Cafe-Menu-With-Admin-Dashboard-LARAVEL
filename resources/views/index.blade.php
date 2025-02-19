<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Menu UI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">     <img src="{{ asset('logo-img.png') }}" alt="Logo">
            <h4>Where Coffee Meets Comfort</h4>
        </div>
        <div class="nav">
            @foreach($categories as $category)
            <div class="nav-item" data-category="{{ $category->id }}">
                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }} Icon" class="category-icon">
                {{ $category->name }}
            </div>
            @endforeach
        </div>
        <div class="buttons" id="subcategoryButtons">
            <!-- Default subcategories -->
            @if($defaultCategory && $defaultCategory->subcategories->isNotEmpty())
                @foreach($defaultCategory->subcategories as $subcategory)
                    <div class="button" data-subcategory="{{ $subcategory->id }}">
                        {{ $subcategory->name }}
                    </div>
                @endforeach
            @else
                <div>No subcategories found.</div>
            @endif
        </div>
        {{-- <div class="buttons" id="subsubcategoryButtons">
            <!-- Default subcategories -->
            @if($defaultCategory && $defaultCategory->subcategories->isNotEmpty())
                @foreach($defaultCategory->subcategories as $subcategory)
                    <div class="button" data-subcategory="{{ $subcategory->id }}">
                        @if($subcategory->subsubcategories->isNotEmpty())
                            <div class="subsubcategories">
                                @foreach($subcategory->subsubcategories as $subsubcategory)
                                    <div class="sub-button" data-subsubcategory="{{ $subsubcategory->id }}">
                                        {{ $subsubcategory->name }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div>No subcategories found.</div>
            @endif
        </div> --}}

        <div class="menu" id="menu-content">
            <!-- Default menu items -->
            @if($defaultCategory && $defaultCategory->subcategories->isNotEmpty())
            @foreach($defaultCategory->subcategories as $subcategory)
                @foreach($subcategory->subsubcategories as $subsubcategory)
                    <div id="subsubcategory-section">
                        <h1>{{$subsubcategory->name}}</h1>
                        @foreach($subsubcategory->products as $product)
                            <div class="item show"
                                data-category="{{ $defaultCategory->id }}"
                                data-subcategory="{{ $subcategory->id }}"
                                data-subsubcategory="{{ $subsubcategory->id }}">
                                <div><strong>{{$product->name}}</strong><br><small>{{$product->description}}</small></div>
                                <div>LL {{$product->price}}</div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        @else
            <div>No menu items found.</div>
        @endif

        </div>
        <div class="footer">
            Qayaa Saida, Lebanon <br>
            +961 70000000 <br>
            <span>&copy; InHouaseCafe 2025 <br> <a style="color: rgb(2, 2, 2)" href="https://devzur.com">Powered By Devzur Agency</a></span>
        </div>
    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
        const subcategoryButtons = document.getElementById('subcategoryButtons');
        const subsubcategorySection = document.getElementById('subsubcategory-section');
        const menuContent = document.getElementById('menu-content');

        // Function to fetch and display subcategories
        function fetchSubcategories(categoryId) {
            fetch('/fetch-menu-subcategory', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ category_id: categoryId })
            })
            .then(response => response.json())
            .then(data => {
                menuContent.innerHTML = ''
                subcategoryButtons.innerHTML = ''; // Clear existing subcategories

                if (data.success && data.data.length > 0) {

                    data.data.forEach(subcategory => {
                        const subcategoryButton = document.createElement('div');
                        subcategoryButton.className = 'button';
                        subcategoryButton.setAttribute('data-subcategory', subcategory.id);
                        subcategoryButton.textContent = subcategory.name;
                        subcategoryButtons.appendChild(subcategoryButton);

                    });

                    // Automatically select the first subcategory
                    const firstSubcategory = subcategoryButtons.querySelector('.button');
                    if (firstSubcategory) firstSubcategory.click();
                } else {
                    subcategoryButtons.innerHTML = '<div>No subcategories found.</div>';
                    menuContent.innerHTML = '<div>No menu items found.</div>';
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Handle sub-subcategory clicks
        subcategoryButtons.addEventListener('click', function(event) {
            if (event.target.classList.contains('sub-subcategory-button')) {
                const subSubcategoryId = event.target.getAttribute('data-subsubcategory');
                fetchMenuItems(subSubcategoryId);
            }
        });


        // Function to fetch and display menu items
        function fetchMenuItems(subcategoryId) {
            fetch('/fetch-menu-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    subcategory_id: subcategoryId
                })
            })
            .then(response => response.json())
            .then(data => {

                // Clear existing menu items
                menuContent.innerHTML = '';

                // Populate the menu items
                if (data.success && data.data.length > 0) {
                    data.data.forEach(function(subsubcategory) {
                    // Create a container for the sub-subcategory
                    const subsubcategoryContainer = document.createElement('div');
                    subsubcategoryContainer.className = 'subsubcategory-container';
                    subsubcategoryContainer.setAttribute('data-subsubcategory', subsubcategory.id);

                    // Add a heading for the sub-subcategory
                    const subsubcategoryHeading = document.createElement('h1');
                    subsubcategoryHeading.textContent = subsubcategory.name;
                    subsubcategoryContainer.appendChild(subsubcategoryHeading);

                    // Loop through the products in this sub-subcategory
                    subsubcategory.products.forEach(function(product) {
                        // Create a product item
                        const item = document.createElement('div');
                        item.className = 'item';
                        item.setAttribute('data-category', product.category_id);
                        item.setAttribute('data-subcategory', product.subcategory_id);
                        item.setAttribute('data-subsubcategory', subsubcategory.id); // Add sub-subcategory ID
                        item.innerHTML = `
                            <div><strong>${product.name}</strong><br><small>${product.description}</small></div>
                            <div>LL ${product.price}</div>
                        `;

                        // Append the product item to the sub-subcategory container
                        subsubcategoryContainer.appendChild(item);
                    });

                    // Append the sub-subcategory container to the menu content
                    menuContent.appendChild(subsubcategoryContainer);
                });
                } else {
                    menuContent.innerHTML = '<div>No menu items found.</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Handle category clicks
        navItems.forEach(function(navItem) {
            navItem.addEventListener('click', function() {
                const categoryId = navItem.getAttribute('data-category');
                fetchSubcategories(categoryId);
            });
        });

        // Handle subcategory clicks
        subcategoryButtons.addEventListener('click', function(event) {
            if (event.target.classList.contains('button')) {
                const subcategoryId = event.target.getAttribute('data-subcategory');
                fetchMenuItems(subcategoryId);
            }
        });

        // // Load default subcategories and menu items on page load
        // const defaultCategory = document.querySelector('.nav-item');
        // if (defaultCategory) {
        //     const defaultCategoryId = defaultCategory.getAttribute('data-category');
        //     fetchSubcategories(defaultCategoryId); // Fetch subcategories for the default category
        // }
    });
</script>
</html>
