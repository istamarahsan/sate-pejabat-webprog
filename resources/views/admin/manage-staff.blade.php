@extends('layouts.dashboard', ['test'=>$branches])

@section('child-content')
    <div class="mx-2 my-2 flex flex-col items-start">
        <h1 class="text-3xl font-black flex flex-grow w-full items-baseline">Manage Staff 
            <a class="ml-auto" href="/admin/{{ $branchId }}/add-staff">
                <div class="ml-2 py-1 px-2 rounded-lg text-sm text-center align-middle bg-black text-white hover:bg-zinc-700 transition-colors duration-200">
                    New Staff
                </div>
            </a>
        </h1>
        <div class="bg-zinc-800 rounded-md py-2 mt-4">
            <table class="table-auto text-left">
                <thead>
                    <tr>
                        <th class="font-thin px-4 py-2">Id</th>
                        <th class="font-thin px-4">Name</th>
                        <th class="font-thin px-4">Position</th>
                        <th class="font-thin px-4">Date of Birth</th>
                        <th class="font-thin px-4">Phone Number</th>
                        <th class="font-thin px-4"><p class="px-3">Actions</p></th>
                        <th class="font-thin px-4"> </th>
                    </tr>
                </thead>
                <tbody>
                    @if( count($staffMembers) <= 0 )
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">Nobody but us chickens!</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                        </tr>
                    @endif
                    @foreach ($staffMembers as $staff)
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900">{{ $staff['id'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $staff['name'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $staff['roleName'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $staff['dateOfBirth'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $staff['phoneNumber'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <a href="/admin/{{ $branchId }}/edit-staff/{{ $staff['id'] }}" class="hover:bg-zinc-800 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Edit</a>
                            </td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <form action="/admin/{{ $branchId }}/delete/{{ $staff['id'] }}" method="post">
                                    @csrf
                                    <button type="submit" class="hover:bg-zinc-800 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Delete</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
    {{-- <div class="flex flex-col items-center gap-10">
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
    </div> --}}
@endsection