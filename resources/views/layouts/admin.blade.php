<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'DeliveBoo')
    </title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app" style="min-height: 100vh; overflow-x:hidden;" class="d-flex flex-column">
        <header class="bg_color navbar py-3 px-1 p-sm-3 p-md-1 shadow">
            <div class="container-lg">
                <a href="http://localhost:5174/#/">
                    <div class="d-none d-md-flex align-items-center">
                        <img style="width: 80px" src="{{ asset('img/wired-lineal-13-pizza.gif') }}" alt="pizza">
                        <img style="width: 200px" src="{{ asset('img/logo1.png') }}" alt="logo">
                    </div>
                </a>


                <div class="d-flex gap-3">
                    <button class="d-none d-sm-block btn header-button">
                        <a class="col_select text-decoration-none" href="http://localhost:5174/#/">
                            <i class="fa-solid fa-house"></i> Home
                        </a>
                    </button>

                    @guest
                        <button class="btn header-registration-button">
                            <a class="col_white text-decoration-none" href="{{ route('register') }}">
                                <i class="fa-solid fa-user-pen"></i> Registrati
                            </a>
                        </button>

                        <button class="btn header-registration-button">
                            <a class="col_white text-decoration-none" href="{{ route('login') }}">
                                <i class="fa-solid fa-user"></i> Accedi
                            </a>
                        </button>
                    @endguest

                    @auth
                        <button class="d-none d-sm-block btn header-button">
                            <a class="col_select text-decoration-none" href="{{ route('admin.restaurants.index') }}">
                                <i class="fa-solid fa-burger"></i> ristoranti
                            </a>
                        </button>

                        <button class="cssbuttons-io-button">
                            <div class="icon">
                                <img style="width: 40px" src="{{ asset('img/wired-lineal-268-avatar-man.gif') }}"
                                    alt="user">
                            </div>

                            {{ Auth::user()->name }}
                        </button>


                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button class="btn header-button"
                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    @endauth

                </div>
        </header>

        <div style="flex: 1" class="bg_color_gradient container-fluid">
            <div class="row">
                @auth
                    <main class="py-5">
                        @yield('content')
                    </main>
                @endauth

                @guest
                    <main class="pt-5">
                        @yield('content')
                    </main>
                @endguest
            </div>

            @guest
                <footer>
                    <p style="font-size: small;" class="mt-3 text-body-secondary text-center">Deliveboo | © 2023</p>
                </footer>
            @endguest


        </div>
    </div>
</body>

</html>


<style lang="scss" scoped>
    .header-button {
        padding: 9px 20px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        background-color: white;
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-size: 15px;
        transition: all 0.5s ease;
    }

    .header-button:hover {
        background-color: #3d348b;
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;

        .col_select,
        i {
            color: white;
            font-weight: bold;
        }
    }

    .header-registration-button {
        padding: 9px 20px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        background-color: #3d348b;
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-size: 15px;
        transition: all 0.5s ease;
    }

    .header-registration-button:hover {
        letter-spacing: 3px;
        background-color: white;
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;

        .col_white,
        i {
            color: #3d348b;
            font-weight: bold;
        }
    }

    .cssbuttons-io-button {
        background: #3d348b;
        color: white;
        font-family: inherit;
        padding: 0.35em;
        padding-left: 0.5em;
        font-size: 17px;
        font-weight: 500;
        border-radius: 0.9em;
        border: none;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        box-shadow: inset 0 0 1.6em -0.6em #714da6;
        overflow: hidden;
        position: relative;
        height: 2.8em;
        padding-right: 3.3em;
        cursor: pointer;
    }

    .cssbuttons-io-button .icon {
        background: white;
        margin-left: 0.4em;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.2em;
        width: 2.2em;
        border-radius: 0.7em;
        box-shadow: 0.1em 0.1em 0.6em 0.2em #3d348b;
        right: 0.3em;
        transition: all 0.3s;
    }
</style>
