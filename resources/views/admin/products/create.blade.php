@extends("layouts.dashboard")

@section("child-content")
<div class="mx-2 my-2 flex flex-col items-start">
    <form method="post" action="{{route('admin.products.store')}}">
        @csrf
        <div class="w-full grid grid-cols-2">
            <label for="name">Name:</label>
            <input class="text-black" id="name" name="name" type="text" />
        </div>
        <br />
        <div class="w-full grid grid-cols-2">
            <label for="price">Price:</label>
            <input class="text-black" id="price" name="price" type="number" />
        </div>
        <br />
        <div class="w-full grid grid-cols-2">
            <label for="category">Category:</label>
            <select class="text-black" id="category" name="category" required>
                @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <br />
        <button class="px-4 py-2 bg-black hover:bg-zinc-900 rounded-xl">
            Create
        </button>
    </form>
</div>
@endsection