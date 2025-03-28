@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="mb-5">
        <h2 class="display-5">
            Welcome on the web's best hot sauce reviews!
        </h2>
        @guest
        <h3>Please login to add your own sauce or to rate the existing ones</h3>
        @endguest
    </div>

    <button class="btn btn-primary btn-lg shadow-sm rounded-pill py-2 px-5">
        @guest
        <a class="nav-link mx-3" href="{{ route('login') }}">LOGIN</a>
        @else
        <a class="nav-link mx-3" href="{{ route('sauces.index') }}">RATE SAUCES</a>
        @endguest
    </button>

    @guest
    <div class="mt-3">
        <p>
            Don't have an account ? <br> 
            <a href="{{ route('register') }}">Create an account here</a>
        </p>
    </div>
    @endguest
</div>
@endsection