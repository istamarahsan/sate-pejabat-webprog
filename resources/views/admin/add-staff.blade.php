<x-app-layout>
    <form action="/admin/{{ $branch['id'] }}/add-staff" method="POST">
        @csrf

        @error('fullName')
        <span>waduh</span>
        @enderror
        <div class="w-full grid grid-cols-2">
            <label class="" for="fullName">Staff Name:</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>
        <br>

        <!-- Date of Birth -->
        @error('dateOfBirth')
        <span>waduh</span>
        @enderror
        <div class="w-full grid grid-cols-2">
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required>
        </div>
        <br>

        <!-- Phone Number -->
        @error('phoneNumber')
        <span>waduh</span>
        @enderror
        <div class="w-full grid grid-cols-2">
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
        </div>
        <br>

        <!-- Address -->
        @error('address')
        <span>waduh</span>
        @enderror
        <div class="w-full grid grid-cols-2">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <br>

        <!-- Staff Role -->
        @error('roleId')
        <span>waduh</span>
        @enderror
        <div class="w-full grid grid-cols-2">
            <label for="roleId">Staff Role:</label>
            <select id="roleId" name="roleId" required>
                @foreach ($staffRoles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <!-- Submit Button -->
        <button class="w-full bg-black rounded-xl text-white py-2" type="submit">Add Staff</button>
    </form>
</x-app-layout>
