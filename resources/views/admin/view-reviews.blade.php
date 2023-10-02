<x-app-layout>
    <div class="flex flex-col items-center gap-10 text-center">
        <table class="w-full">
            <tr>
                <th>Nama</th>
                <th>Rasa</th>
                <th>Suasana</th>
                <th>Harga</th>
                <th>Pelayanan</th>
                <th>Kebersihan</th>
                <th>Kesan</th>
                <th>Impian</th>
                <th>Tanggal</th>
            </tr>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review['name'] }}</td>
                    <td>{{ $review['taste'] }}</td>
                    <td>{{ $review['atmosphere'] }}</td>
                    <td>{{ $review['price'] }}</td>
                    <td>{{ $review['service'] }}</td>
                    <td>{{ $review['cleanliness'] }}</td>
                    <td>{{ $review['comments'] }}</td>
                    <td>{{ $review['goals'] }}</td>
                    <td>{{ $review['date'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
