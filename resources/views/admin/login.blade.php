<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="body">
    <section class="login--container">
        <div class="login--box">
            <div class="login--header">
                <h2>Login to <span>In </span> House</h2>
            </div>
            <!-- Make sure the action points to the correct path -->
            <form class="login--form" action="{{route('login')}}" method="POST">
                @csrf
                <div class="form--group">
                    <label for="email">Username</label>
                    <input type="text" id="email" name="email" placeholder="Enter your username" required>
                </div>
                <div class="form--group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login--button">Login</button>
            </form>
        </div>
    </section>
</body>
</html>
