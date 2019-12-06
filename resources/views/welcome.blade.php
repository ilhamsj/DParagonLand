<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ secure_url('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col-8 text-center">
                <h1>Hallo selamat datang di {{ env('APP_NAME') }}</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum, animi! Corrupti magnam, molestiae error libero iure facilis excepturi sit dolor quam ratione rerum provident architecto officiis quae ullam et possimus.
                </p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </div>
    <script src="{{ secure_url('js/app.js') }}"></script>
</body>
</html>