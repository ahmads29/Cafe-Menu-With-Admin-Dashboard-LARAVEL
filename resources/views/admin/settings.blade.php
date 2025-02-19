<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Settings</title>
</head>
<body class="body">
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>BillZ</span> Cafe</h2>
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
                    <a href={{ route('categories.index') }} >
                        <span class="icon"><i class="ri-handbag-line"></i></span>
                        <div class="sidebar--item">Category</div>
                    </a>

                </li>
                <li>
                    <a href={{ route('products.index') }} class="">
                        <span class="icon"><i class="ri-handbag-line"></i></span>
                        <div class="sidebar--item">Product</div>
                    </a>

                </li>
                <li>
                    <a href={{ route('settings') }} class="active">
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
                <h3 class="title">Settings</h3>
            </div>
            <div class="settings--content">
                <div class="settings--section">
                    <h4>Change Password</h4>
                    <form class="form" action="{{ route('admin.change-password') }}" id="passwordForm" method="POST">
                        @csrf
                        <div class="form--group">
                            <label for="current-password">Current Password</label>
                            <input name="current_password" type="password" id="current-password" placeholder="Enter current password">
                        </div>
                        <div class="form--group">
                            <label for="new-password">New Password</label>
                            <input type="password" name="new_password" id="new-password" placeholder="Enter new password">
                        </div>
                        <br>
                        <button type="submit" class="update--button">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Account Modal -->
    <div id="addAccountModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addAccountModal')">&times;</span>
            <h2>Add New Account</h2>
            <form id="addAccountForm">
                <div class="form--group">
                    <label for="new-username">Username</label>
                    <input type="text" id="new-username" placeholder="Enter username" required>
                </div>
                <div class="form--group">
                    <label for="new-account-password">Password</label>
                    <input type="password" id="new-account-password" placeholder="Enter password" required>
                </div>
                <br>
                <button type="submit" class="add--button">Add Account</button>
            </form>
        </div>
    </div>

    <script src="assets/js/admin/main.js"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script src="{{ asset('assets/js/admin/main.js')}}"></script>
</body>
</html>
