@extends('layouts.guest')

@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-row items-center h-screen">

        <form method="POST" action="{{ route('auth.login') }}" class="mx-auto w-[20rem] h-fit">
            @csrf

            <h1 class="text-3xl font-black flex flex-grow w-full items-baseline mb-4">Log In</h1>

            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">User Id</span>
                </label>
                <input autocomplete="username" type="text" id="userId" name="userId" placeholder="Id" class="input input-bordered w-full max-w-xs" required />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input autocomplete="password" type="password" id="password" name="password" placeholder="Password" class="input input-bordered w-full max-w-xs" required />
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-3 label-text">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button class="btn ml-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
@endsection
