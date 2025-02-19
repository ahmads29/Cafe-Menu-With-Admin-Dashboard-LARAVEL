<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>In House</title>
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
                <li><a href={{ route('admin') }} class="active"><span class="icon"><i class="ri-bar-chart-line"></i></span><div class="sidebar--item">Overview</div></a></li>
                <li><a href={{ route('categories.index') }} ><span class="icon"><i class="ri-handbag-line"></i></span><div class="sidebar--item">Category</div></a></li>
                <li><a href={{ route('products.index') }} ><span class="icon"><i class="ri-handbag-line"></i></span><div class="sidebar--item">Product</div></a></li>
                <li><a href={{ route('settings') }}><span class="icon"><i class="ri-settings-3-line"></i></span><div class="sidebar--item">Settings</div></a></li>
            </ul>
            <ul class="sidebar--bottom--items">
                <li><a href={{ route('logout') }}><span class="icon"><i class="ri-logout-box-r-line"></i></span><div class="sidebar--item">Logout</div></a></li>
            </ul>
        </div>
        <div class="main--container">
            <div class="cards">
                <a href="{{ route('products.create') }}">
                    <div class="card card-2">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-gift-line"></i></span>
                            <span>Items</span>
                        </div>
                        <h3 class="card--value"><i class="ri-add-circle-line up"></i></h3>
                        <div class="chart"><canvas id="orders"></canvas></div>
                        <div class="card--overlay-wrapper">
                            <button class="card--overlay">Manage</button>
                        </div>
                    </div>
                </a>
                <a href="{{ route('categories.create') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-3">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-handbag-line"></i></span>
                            <span>Categories</span>
                        </div>
                        <h3 class="card--value"><i class="ri-add-circle-line up"></i></h3>
                        <div class="chart"><canvas id="categories"></canvas></div>
                        <div class="card--overlay-wrapper">
                            <span class="card--overlay">Manage</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/admin/main.js')}}"></script>
</body>
</html>
