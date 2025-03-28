<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .navbar {
            height: 100px; /* Augmentez la hauteur si nécessaire */
        }
        .navbar-brand {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1000;
            padding: 10px; /* Ajoutez du padding pour éviter la coupure */
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg bg-dark text-white shadow-sm fixed-top">
            <div class="container position-relative">
                <!-- Menu de gauche -->
                <ul class="navbar-nav me-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('sauces.index') }}">ALL SAUCES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('sauces.my-sauces') }}">MY SAUCES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('sauces.create') }}">ADD SAUCE</a>
                    </li>
                    @endauth
                </ul>

                <!-- Nom du site au centre -->
                <div class="navbar-brand">
                    <h2 class="text-white">
                        <a class="nav-link text-white" href="{{ route('home') }}">🔥HOT TAKES🔥</a>
                    </h2>
                    <p class="text-white" style="font-size: 0.8rem;">The web's best hot sauce reviews</p>
                </div>

                <!-- Menu de droite -->
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">REGISTER</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           LOGOUT
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="mb-5 flex-grow-1" style="margin-top: 150px;">
            @yield('content')
        </main>

        <footer class="bg-dark text-center text-lg-start mt-auto">
            <div class="text-center p-3 text-white">
                &copy; 2025 HOT TAKES
            </div>
        </footer>
    </div>
</body>
</html>
