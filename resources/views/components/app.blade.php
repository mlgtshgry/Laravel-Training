<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200">
    <div class="navbar bg-base-100 shadow-lg">
        <div class="flex-1">
            <a href="{{ url('/') }}" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                @guest
                    <!-- <li><a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a></li> -->
                @endguest
                @auth
                    <li><a href="{{ route('auth.logout') }}" class="btn btn-error btn-sm">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <div class="container mx-auto p-4 md:p-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">{{ $title }}</h2>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>