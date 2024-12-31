<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('front/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('front/CSS/store-home-page.css') }}" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>Store | @yield('title')</title>
    @yield('styles')
</head>

<body class="mb-48">
    <x-front.flash-message />
    <header class="header">
        <a href="{{ Route('store.home') }}" class="logo">
            <img class="w-24" src="{{ asset('front/images/logo.png') }}" alt="logo"></a>
        <nav class="navbar">
            <a href="{{ Route('store.home') }}" style="--i: 1" class="active">Home</a>
            <a href="{{ Route('allListings') }}" style="--i: 2">
                @auth
                    My Listings
                @else
                    All Listings
                @endauth
            </a>
            <a href="#" style="--i: 3">Review</a>
            <a href="#" style="--i: 4">Featured</a>
            <a href="#" style="--i: 5">Contact</a>
        </nav>
        <ul class="flex space-x-6 mr-6 text-lg ico">
            @auth
                <li>
                    <span class="font-bold uppercase">
                        Welcome {{ auth()->user()->name }}
                    </span>
                </li>
                <li>
                    <a href="{{ Route('manage') }}"><i class="fa-solid fa-gear"></i> Manage
                        Listings</a>
                </li>
                <li>
                    <form class="inline" method="POST" action="{{ Route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ Route('register') }}"><i class="fa-solid fa-user-plus"></i>
                        Register</a>
                </li>
                <li>
                    <a href="{{ Route('login') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a>
                </li>
            @endauth
        </ul>
    </header>

    <!-- Hero -->
    <!-- Search -->

    @yield('content')


    <footer
        class="fixed bottom-0 left-0 w-full flex justify-around items-center font-bold text-white h-16 mt-24 opacity-90">
        <p class="ml-2 flex items-center">
            <a class="flex items-center" href="{{ Route('store.home') }}">
                <img class="w-24" src="{{ asset('front/images/logo.png') }}" alt="logo">
                {{ env('APP_NAME') }}</a>, Copyright
            &copy;{{ now()->year }} - {{ now()->year + 1 }}. All Rights reserved
        </p>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> {{ env('APP_VERSION') }}
        </div>
        <a href="{{ Route('create') }}" class="right-10 bg-black text-white py-2 px-5">Post Job</a>
    </footer>
    @yield('scripts')

</body>

</html>
