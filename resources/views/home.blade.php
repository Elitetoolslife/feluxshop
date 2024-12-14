<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Welcome, {{ session('username') }}</h2>
                <p>Your balance is: ${{ session('balance') }}</p>
                <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>