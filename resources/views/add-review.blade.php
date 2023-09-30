<x-app-layout>
    <form action="/review" method="POST">
        @csrf

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="taste">Rasa makanan</label><br>
        <input type="radio" id="taste1" name="taste" value="1" required>
        <label for="taste1">1</label>
        <input type="radio" id="taste2" name="taste" value="2">
        <label for="taste2">2</label>
        <input type="radio" id="taste3" name="taste" value="3">
        <label for="taste3">3</label><br><br>

        <label for="atmosphere">Suasana</label><br>
        <input type="radio" id="atmosphere1" name="atmosphere" value="1" required>
        <label for="atmosphere1">1</label>
        <input type="radio" id="atmosphere2" name="atmosphere" value="2">
        <label for="atmosphere2">2</label>
        <input type="radio" id="atmosphere3" name="atmosphere" value="3">
        <label for="atmosphere3">3</label><br><br>

        <label for="cleanliness">Kebersihan</label><br>
        <input type="radio" id="cleanliness1" name="cleanliness" value="1" required>
        <label for="cleanliness1">1</label>
        <input type="radio" id="cleanliness2" name="cleanliness" value="2">
        <label for="cleanliness2">2</label>
        <input type="radio" id="cleanliness3" name="cleanliness" value="3">
        <label for="cleanliness3">3</label><br><br>

        <label for="service">Pelayanan</label><br>
        <input type="radio" id="service1" name="service" value="1" required>
        <label for="service1">1</label>
        <input type="radio" id="service2" name="service" value="2">
        <label for="service2">2</label>
        <input type="radio" id="service3" name="service" value="3">
        <label for="service3">3</label><br><br>

        <label for="price">Harga</label><br>
        <input type="radio" id="price1" name="price" value="1" required>
        <label for="price1">1</label>
        <input type="radio" id="price2" name="price" value="2">
        <label for="price2">2</label>
        <input type="radio" id="price3" name="price" value="3">
        <label for="price3">3</label><br><br>

        <label for="comments">Bagaimana kesan atau pesan anda?</label><br>
        <textarea id="comments" name="comments" rows="4" cols="50"></textarea><br><br>

        <label for="goals">Apakah impian anda saat ini?</label><br>
        <textarea id="goals" name="goals" rows="4" cols="50"></textarea><br><br>

        <button class="bg-black text-white rounded-md p-2" type="submit">Submit Review</button>
    </form>
</x-app-layout>