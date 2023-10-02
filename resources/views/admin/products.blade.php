@extends("layouts.dashboard")

@section("child-content")
    <div class="mx-2 my-2 flex flex-col items-start">
        <div class="grid grid-cols-5 text-center gap-5">
            <div>Id</div>
            <div>Name</div>
            <div>Price</div>
            <div class="col-span-2"></div>
        </div>
        @if(count($products) <= 0)
            <div class="text-zinc-500">Nobody but us chickens!</div>
        @endif
        @foreach($products as $product)
            <div class="grid grid-cols-5 text-center gap-5">
                <div>{{ $product['id'] }}</div>
                <div>{{ $product['name'] }}</div>
                <div>{{ $product['price'] }}</div>
                <div class="col-span-2"></div>
            </div>
        @endforeach
    </div>
@endsection