@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <img style="max-width:100px" src="https://images-na.ssl-images-amazon.com/images/I/8166xCVDGnL._SY355_.jpg" alt="" srcset="">
                    <a href="">Ganti Foto</a>
                </div>
                <div class="card-body">
                    Nama :
                    <h3>{{ Auth::user()->name }}</h3>
                    <hr>
                    
                    Email :
                    <h3>{{ Auth::user()->email }}</h3>
                    <hr>
                    
                    phone :
                    <h3>{{ Auth::user()->phone }}</h3>
                    <hr>

                    <a href="">Ganti Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
