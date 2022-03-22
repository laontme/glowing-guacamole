<!doctype html>
<html lang="{{ config('app.locale') }}" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body class="h-full">
<header>
    @section('header')
        <div class="m-4 border-1 bg-emerald-400 border rounded-full p-5 shadow-2xl">
            <nav class="mx-3 flex justify-between">
                <ul class="flex gap-5">
                    <li class="list-none">
                        <a class="outline-none hover:bg-white p-2 rounded hover:text-black smooth text-white" href="{{ route('landing') }}">
                            Home
                        </a>
                    </li>
                    @auth
                    <li class="list-none">
                        <a class="outline-none hover:bg-white p-2 rounded hover:text-black smooth text-white" href="{{ route('user.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    @endauth
                </ul>
                <ul class="flex gap-5">
                    @auth
                    <li class="list-none">
                        <a class="outline-none hover:bg-white p-2 rounded hover:text-black smooth text-white" href="{{ route('user.settings') }}">
                            {{ auth()->user()['data']['email'] }}
                        </a>
                    </li>
                    @else
                    <li class="list-none">
                        <a class="outline-none hover:bg-white p-2 rounded hover:text-black smooth text-white" href="{{ route('user.login') }}">
                            Login
                        </a>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    @show
</header>
<main class="m-10">
    @yield('main')
</main>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
