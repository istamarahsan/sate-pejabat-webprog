@extends('layouts.guest')

@section('content')
    <div class="flex flex-col items-center justify-center my-10">
        <form action="{{ route('review') }}" method="POST" class="flex flex-col items-stretch max-w-lg gap-5">
            @csrf

            <h1 class="text-3xl font-black flex flex-grow w-full items-baseline mb-4">Make a Review</h1>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama Panjang</span>
                </label>
                <input autocomplete="off" type="text" id="name" name="name" placeholder="Name" class="input input-bordered w-full" required />
            </div>

            <label class="label">
                <span class="label-text">Rasa Makanan</span>
            </label>
            <div class="form-control w-full flex">
                <div class="mx-auto flex flex-row justify-between w-3/4">
                    <input type="radio" name="taste" class="radio" value="1" />
                    <input type="radio" name="taste" class="radio" value="2" />
                    <input type="radio" name="taste" class="radio" value="3" />
                    <input type="radio" name="taste" class="radio" value="4" />
                    <input type="radio" name="taste" class="radio" value="5" />
                    <input type="radio" name="taste" class="radio" value="6" checked />
                </div>
                <label class="mx-auto label w-3/4 p-0 py-2">
                    <span class="label-text text-xs">Tidak Enak</span>
                    <span class="label-text text-xs">Sangat Enak</span>
                </label>
            </div>

            <label class="label">
                <span class="label-text">Suasana Restoran</span>
            </label>
            <div class="form-control w-full flex">
                <div class="mx-auto flex flex-row justify-between w-3/4">
                    <input type="radio" name="atmosphere" class="radio" value="1" />
                    <input type="radio" name="atmosphere" class="radio" value="2" />
                    <input type="radio" name="atmosphere" class="radio" value="3" />
                    <input type="radio" name="atmosphere" class="radio" value="4" />
                    <input type="radio" name="atmosphere" class="radio" value="5" />
                    <input type="radio" name="atmosphere" class="radio" value="6" checked />
                </div>
                <label class="mx-auto label w-3/4 p-0 py-2">
                    <span class="label-text text-xs">Tidak Nyaman</span>
                    <span class="label-text text-xs">Sangat Nyaman</span>
                </label>
            </div>

            <label class="label">
                <span class="label-text">Tingkat Kebersihan</span>
            </label>
            <div class="form-control w-full flex">
                <div class="mx-auto flex flex-row justify-between w-3/4">
                    <input type="radio" name="cleanliness" class="radio" value="1" />
                    <input type="radio" name="cleanliness" class="radio" value="2" />
                    <input type="radio" name="cleanliness" class="radio" value="3" />
                    <input type="radio" name="cleanliness" class="radio" value="4" />
                    <input type="radio" name="cleanliness" class="radio" value="5" />
                    <input type="radio" name="cleanliness" class="radio" value="6" checked />
                </div>
                <label class="mx-auto label w-3/4 p-0 py-2">
                    <span class="label-text text-xs">Sangat Kotor</span>
                    <span class="label-text text-xs">Sangat Bersih</span>
                </label>
            </div>

            <label class="label">
                <span class="label-text">Tingkat Pelayanan</span>
            </label>
            <div class="form-control w-full flex">
                <div class="mx-auto flex flex-row justify-between w-3/4">
                    <input type="radio" name="service" class="radio" value="1" />
                    <input type="radio" name="service" class="radio" value="2" />
                    <input type="radio" name="service" class="radio" value="3" />
                    <input type="radio" name="service" class="radio" value="4" />
                    <input type="radio" name="service" class="radio" value="5" />
                    <input type="radio" name="service" class="radio" value="6" checked />
                </div>
                <label class="mx-auto label w-3/4 p-0 py-2">
                    <span class="label-text text-xs">Sangat Buruk</span>
                    <span class="label-text text-xs">Sangat Baik</span>
                </label>
            </div>

            <label class="label">
                <span class="label-text">Harga Makanan</span>
            </label>
            <div class="form-control w-full flex">
                <div class="mx-auto flex flex-row justify-between w-3/4">
                    <input type="radio" name="price" class="radio" value="1" />
                    <input type="radio" name="price" class="radio" value="2" />
                    <input type="radio" name="price" class="radio" value="3" />
                    <input type="radio" name="price" class="radio" value="4" />
                    <input type="radio" name="price" class="radio" value="5" />
                    <input type="radio" name="price" class="radio" value="6" checked />
                </div>
                <label class="mx-auto label w-3/4 p-0 py-2">
                    <span class="label-text text-xs">Sangat Mahal</span>
                    <span class="label-text text-xs">Sangat Terjangkau</span>
                </label>
            </div>

            <label class="label">
                <span class="label-text">Kesan Anda</span>
            </label>
            <textarea id="comments" name="comments" rows="4" cols="50" class="textarea textarea-bordered h-24"></textarea>

            <label class="label">
                <span class="label-text">Impian Anda saat ini</span>
            </label>
            <textarea id="goals" name="goals" rows="4" cols="50" class="textarea textarea-bordered h-24"></textarea>

            <button class="btn mt-8 btn-accent" type="submit">Submit Review</button>
        </form>
    </div>
@endsection
