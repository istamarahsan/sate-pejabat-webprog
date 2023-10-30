@extends('layouts.dashboard')

@section('child-content')
    <div class="mx-2 my-2 flex flex-col items-start">
        <a href="{{ route('admin.staff.index') }}">
            <div class="py-2 px-4 rounded-lg text-sm text-center align-middle bg-black text-white hover:bg-zinc-700 transition-colors duration-200 flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Back
            </div>
        </a>
        <h1 class="text-3xl my-4 font-black flex flex-grow w-full items-baseline">Add New Staff</h1>
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf

            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Staff Name</span>
                </label>
                <input autocomplete="off" type="text" id="fullName" name="fullName" placeholder="Name" class="input input-bordered w-full max-w-xs" required />
                @error('fullName')
                    <label class="label">
                        <span class="label-text">Staff Name cannot be empty!</span>
                    </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Date of Birth</span>
                </label>
                <input autocomplete="off" type="date" id="dateOfBirth" name="dateOfBirth" class="input input-bordered w-full max-w-xs" required />
                @error('dateOfBirth')
                    <label class="label">
                        <span class="label-text">Date cannot be empty!</span>
                    </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Phone Number</span>
                </label>
                <input autocomplete="off" type="tel" id="phoneNumber" name="phoneNumber" class="input input-bordered w-full max-w-xs" required />
                @error('phoneNumber')
                    <label class="label">
                        <span class="label-text">Phone number cannot be empty!</span>
                    </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Address</span>
                </label>
                <textarea autocomplete="off" type="text" id="address" name="address" class="textarea textarea-bordered h-24" placeholder="Bio" required></textarea>
                @error('address')
                    <label class="label">
                        <span class="label-text">Address cannot be empty!</span>
                    </label>
                @enderror
            </div>
            <label class="label">
                <span class="label-text">Assigned Role</span>
            </label>
            <select id="roleId" name="roleId" class="select select-bordered w-full max-w-xs" required>
                @foreach ($staffRoles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
            </select>

            <button class="px-4 py-2 mt-8 w-full bg-white text-black hover:bg-zinc-300 rounded-xl">
                Create Staff
            </button>
        </form>
    </div>
@endsection

{{-- @section('content')
    <form class="text-black" action="{{ route('admin.staff.update', ['staff' => $user['id']]) }}" method="POST">
        @csrf
        

        <div class="w-full grid grid-cols-2">
            <label class="" for="fullName">Staff Name:</label>
            <input value="{{ $user['name'] }}" type="text" id="fullName" name="fullName" required>
        </div>
        <br>

        <!-- Date of Birth -->
        <div class="w-full grid grid-cols-2">
            <label for="dateOfBirth">Date of Birth:</label>
            <input value="{{ $user['dateOfBirth'] }}" type="date" id="dateOfBirth" name="dateOfBirth" required>
        </div>
        <br>

        <!-- Phone Number -->
        <div class="w-full grid grid-cols-2">
            <label for="phoneNumber">Phone Number:</label>
            <input value="{{ $user['phoneNumber'] }}" type="tel" id="phoneNumber" name="phoneNumber" required>
        </div>
        <br>

        <!-- Address -->
        <div class="w-full grid grid-cols-2">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required>{{ $user['address'] }}</textarea>
        </div>
        <br>

        <!-- Staff Role -->
        <div class="w-full grid grid-cols-2">
            <label for="role">Staff Role:</label>
            <select id="role" name="role" required>
                @foreach ($staffRoles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <!-- Submit Button -->
        <button class="w-full bg-black rounded-xl text-white py-2" type="submit">Save
            Changes</button>
    </form>
@endsection --}}
