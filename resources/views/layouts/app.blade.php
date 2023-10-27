<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @livewireStyles

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flowbite.min.js'])
</head>

<body class="bg-zinc-900 min-h-screen min-w-screen text-white flex flex-col">
    <header class="min-w-screen p-2 border border-zinc-800 border-t-0 border-x-0 flex items-center text-white">
        <button class="font-black text-3xl">
            TEST
        </button>
        <div class="text-zinc-500 font-bold flex items-center">
            <a href="{{ route('admin.dashboard') }}">
                <button class="ml-3 rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                    Dashboard
                </button>
            </a>
            <button class="ml-2 rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                Manage
            </button>
            <a href="{{ route('admin.reviews.index') }}">
                <button class="ml-2 rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                    Reviews
                </button>
            </a>
        </div>
        <button class="ml-auto text-white font-normal text-sm rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
            Welcome, {{ 'X' }}{{ auth()->user()->id }}
        </button>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button class="ml-auto text-white font-normal text-sm rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                Logout
            </button>
        </form>
    </header>
    @yield('content')
    @livewireScripts
</body>

</html>
