<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

<<<<<<< Updated upstream
        @livewireStyles

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
=======
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=lexend:100,200,300,400,500,600,700,800,900|lexend-deca:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- this laravel version of tailwind is gay -->
    <body class="font-['Lexend'] bg-zinc-900 text-white">
        <header class="font-book min-w-screen p-4 bg-transparent border border-l-0 border-t-0 border-r-0 border-zinc-700 flex flex-row items-center">
            <button class="text-2xl mr-4">
                SATE PEJABAT
            </button>
            <div class="text-zinc-300">
                <button class="mr-3">
                    Dashboard
                </button>
                <button class="mr-3">
                    Placeholder
                </button>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
>>>>>>> Stashed changes
    </body>
</html>
