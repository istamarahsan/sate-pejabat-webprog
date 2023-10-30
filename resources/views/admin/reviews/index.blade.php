@extends('layouts.staff')

@section('content')
    <div class="my-2 flex flex-col items-center text-center w-screen">
        <h1 class="text-3xl font-black text-left w-1/2 items-baseline">Reviews</h1>
        <div class="bg-zinc-800 rounded-md w-1/2 py-2 mt-2">
            <table class="table-auto w-full text-left">
                <tr>
                    <th class="font-thin px-4 py-2">Nama</th>
                    <th class="font-thin px-4">Rasa</th>
                    <th class="font-thin px-4">Suasana</th>
                    <th class="font-thin px-4">Harga</th>
                    <th class="font-thin px-4">Pelayanan</th>
                    <th class="font-thin px-4">Kebersihan</th>
                    <th class="font-thin px-4">Kesan</th>
                    <th class="font-thin px-4">Impian</th>
                    <th class="font-thin px-4">Tanggal</th>
                </tr>
                @if (count($reviews) <= 0)
                    <tr>
                        <td colspan="9"
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            Nobody but us chickens!</td>
                    </tr>
                @endif
                @foreach ($reviews as $review)
                    <tr>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['name'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['taste'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['atmosphere'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ number_format($review['price']) }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['service'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['cleanliness'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['comments'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['goals'] }}</td>
                        <td
                            class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                            {{ $review['date'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
