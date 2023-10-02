@extends('layouts.dashboard', ['test'=>$branches])

@section('child-content')
    <div class="flex flex-col items-center gap-10">
        <a href="/admin/{{ $branchId }}/add-staff">
            <div class="p-2 px-5 rounded-xl bg-black text-white w-fit">Add New Staff Member</div>
        </a>
        <div>
            <div class="grid grid-cols-6 gap-5 text-center">
                <div>Name</div>
                <div>Position</div>
                <div>Age</div>
                <div>Telephone</div>
                <div class="col-span-2"></div>
            </div>
            <hr class="my-4" />
            @foreach ($staffMembers as $staff)
                <div class="grid grid-cols-6 gap-5 my-2">
                    <div>{{ $staff['name'] }}</div>
                    <div>{{ $staff['roleName'] }}</div>
                    <div>{{ $staff['dateOfBirth'] }}</div>
                    <div>{{ $staff['phoneNumber'] }}</div>
                    <div class="grid grid-cols-2 col-span-2 gap-1">
                        <a href="/admin/{{ $branchId }}/edit-staff/{{ $staff['id'] }}">
                            <button type="button"
                                class="bg-black text-white px-3 py-1 rounded-xl">Edit</button>
                        </a>
                        <form action="/admin/{{ $branchId }}/delete/{{ $staff['id'] }}"
                            method="post">
                            @csrf
                            <button type="submit"
                                class="bg-black text-white px-3 py-1 rounded-xl">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection