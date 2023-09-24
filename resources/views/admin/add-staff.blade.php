<x-app-layout>
    <form action="/admin/{{ $branch['id'] }}/add-staff" method="POST">
        @csrf

        <div class="w-full grid grid-cols-2">
            <label class="" for="full_name">Staff Name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <br>
        
        <!-- Date of Birth -->
        <div class="w-full grid grid-cols-2">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
        </div>
        <br>

        <!-- Phone Number -->
        <div class="w-full grid grid-cols-2">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>
        </div>
        <br>

        <!-- Address -->
        <div class="w-full grid grid-cols-2">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <br>

        <!-- Staff Role -->
        <div class="w-full grid grid-cols-2">
            <label for="role">Staff Role:</label>
            <select id="role" name="role" required>
                @foreach($staffRoles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <!-- Submit Button -->
        <button class="w-full bg-black rounded-xl text-white py-2" type="submit">Add Staff</button>
    </form>
</x-app-layout>
