@extends('layouts.app')

@section('content')
<form class="text-black" action="/{{ $branchId }}/admin/editstaff/{{ $user['id'] }}" method="POST">
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
@endsection