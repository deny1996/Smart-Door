<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Door') }}</title>

            <!-- Bootstrap CSS -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Tailwind CSS-->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Stile für den Register-Link */
        .register-link {
            font-size: 1.25rem; /* Größere Schriftgröße */
            font-weight: 600;   /* Fettere Schriftart */
            text-decoration: none; /* Keine Unterstreichung */
            color: white; /* Weißer Text */
            transition: color 0.3s; /* Sanfter Übergang für Farbe */
        }

        .register-link:hover {
            color: #FF2D20; /* Farbe beim Hover */
        }

        /* Restliche Stile für die Seite */
        .card:hover {
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .card {
            border: 1px solid black;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            margin: 2rem;
        }
    </style>
</head>
    <body class="d-flex flex-column min-vh-100">
        <header class="bg-dark py-3 text-center text-white">
            @include('layouts.navigation')
        </header>

        <div class="mt-4 width-auto"> <!-- ANPASSEN!!!-->
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    <footer class="bg-dark py-5 text-center text-white-50 mt-auto">
        <div class="container">
            <p class="mb-1">&copy; Copyright 2024 | Smart Door</p>
        </div>
    </footer>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <!-- Flowbite JS -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    </body>
</html>


