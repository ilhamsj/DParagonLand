@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-8 text-center">
            <h1>Hallo selamat datang di {{ env('APP_NAME') }}</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum, animi! Corrupti magnam, molestiae error libero iure facilis excepturi sit dolor quam ratione rerum provident architecto officiis quae ullam et possimus.
            </p>
            @auth
                <a href="{{ route('login') }}" class="btn btn-primary">Tembak aku</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endauth
        </div>
    </div>
</div>

@endsection