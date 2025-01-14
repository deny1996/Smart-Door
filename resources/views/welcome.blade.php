<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cover Template · Bootstrap v5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        .nav-masthead .nav-link {
            padding-left: 20px;
            padding-right: 20px;
            font-size: 1.25rem;
        }

        .nav-masthead {
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .background {
            background-image: url('{{ asset('storage/img/unlock_door.webp') }}');
            background-size: cover;
            background-position: center;
            filter: blur(1px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }

        .text-container {
            z-index: 1;
            position: relative;
            color: white;
            text-align: center;
            margin-top: 100px;
        }

        footer {
            z-index: 1;
            position: relative;
        }
    </style>
</head>

<body class="d-flex h-100 text-center text-bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                @if (Route::has('login'))
                    <nav class="nav nav-masthead justify-content-center">
                        @auth
                            <a href="{{ route('host.dashboard') }}"
                                class="nav-link fw-bold py-1 px-3 text-dark transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="nav-link fw-bold py-1 px-3 text-dark transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="nav-link fw-bold py-1 px-3 text-dark transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <div class="background"></div>

        <div class="text-container">
            <h1>Smart Door</h1>
            <p class="lead">Welcome to Smart Door, your trusted solution for effortlessly sending guest links to unlock
                your door and enhance your home security!</p>
            <p class="lead">
                <a href="{{ route('host.dashboard') }}" class="btn btn-lg btn-light fw-bold border-white bg-white">Learn
                    more</a>
            </p>
        </div>

        <footer class="mt-auto text-white">
            <p class="mb-1">&copy; Copyright 2024 | Smart Door</p>
        </footer>
    </div>

</body>

</html>