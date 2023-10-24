@extends('layouts.guest')
@section('content')
<div class="flex flex-col items-center p-5">
    <form action="{{route('review')}}" method="POST" class="flex flex-col items-stretch max-w-lg p-2 gap-2">
        @csrf

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required class="text-black">
        <br />

        <label class="text-center" for="taste">Rasa makanan</label>
        <x-review.3-category-input name="taste" low="Lumayan" medium="Enak" high="Sangat Enak" />
        <br />

        <label class="text-center" for="taste">Suasana</label>
        <x-review.3-category-input name="atmosphere" low="Lumayan" medium="Enak" high="Sangat Enak" />
        <br />

        <label class="text-center" for="taste">Kebersihan</label>
        <x-review.3-category-input name="cleanliness" low="Lumayan" medium="Bersih" high="Sangat Bersih" />
        <br />

        <label class="text-center" for="taste">Pelayanan</label>
        <x-review.3-category-input name="service" low="Lumayan" medium="Baik" high="Sangat Baik" />
        <br />

        <label class="text-center" for="taste">Harga</label>
        <x-review.3-category-input name="price" low="Mahal" medium="Sedang" high="Murah" />
        <br />

        <label for="comments">Bagaimana kesan atau pesan anda?</label>
        <textarea id="comments" name="comments" rows="4" cols="50" class="text-black"></textarea>
        <br />

        <label for="goals">Apakah impian anda saat ini?</label>
        <textarea id="goals" name="goals" rows="4" cols="50" class="text-black"></textarea>
        <br />

        <button class="bg-black text-white rounded-md p-2" type="submit">Submit Review</button>
    </form>
</div>
@endsection