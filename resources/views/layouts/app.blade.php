<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.min.js'])
    </head>
    <body class="bg-zinc-900 min-h-screen min-w-screen text-white flex flex-col">
        <header class="min-w-screen p-2 border border-zinc-800 border-t-0 border-x-0 flex items-center text-white">
            <button class="font-black text-3xl">
                TEST
            </button>
            <div class="text-zinc-500 font-bold flex items-center">
                <button class="ml-3 rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                    Dashboard
                </button>
                <button class="ml-0 rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                    Manage
                </button>
                {{-- <button class="ml-0 rounded-lg hover:bg-zinc-800 px-2 py-1">
                    Settings
                </button> --}}
            </div>
            <button class="ml-auto text-white font-normal text-sm rounded-lg transition-colors duration-200 hover:bg-zinc-800 px-2 py-1">
                Welcome, ahsan
            </button>
        </header>
        @yield("content")
    </body>
</html>
