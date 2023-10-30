@extends('layouts.staff')

@section('content')
    <div class="p-4 font-black flex flex-col gap-4">
        <p class="text-3xl">Welcome whoever that is.</p>
        <a class="btn btn-primary max-w-fit" type="button" href="{{ route('staff.createtransaction') }}">
            <p>Want to make Transaction?</p>
        </a>
    </div>
@endsection
