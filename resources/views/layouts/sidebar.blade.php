@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4 p-4">
        <!-- Add child layout content here -->
        @yield('child-content')
    </div>
@endsection