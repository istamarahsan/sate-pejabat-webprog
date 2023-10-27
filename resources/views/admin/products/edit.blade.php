@extends('layouts.dashboard')

@section('child-content')
    <div class="mx-2 my-2 flex flex-col items-start">
        <a href="{{ route('admin.products.index') }}">
            <div class="py-2 px-4 rounded-lg text-sm text-center align-middle bg-black text-white hover:bg-zinc-700 transition-colors duration-200 flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Back
            </div>
        </a>
        <h1 class="text-3xl my-4 font-black flex flex-grow w-full items-baseline">Edit Product "{{ $product['name'] }}"</h1>
        <form method="post" action="{{ route('admin.products.update', ['product' => $product['id']]) }}">
            @method('PUT')
            @csrf

            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Product Name</span>
                </label>
                <input autocomplete="off" type="text" id="name" name="name" placeholder="Name" class="input input-bordered w-full max-w-xs" value="{{ $product['name'] }}" required />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Price</span>
                </label>
                <input autocomplete="off" type="number" id="price" name="price" placeholder="0" class="input input-bordered w-full max-w-xs none" value="{{ $product['price'] }}" required />
            </div>
            <label class="label">
                <span class="label-text">Category</span>
            </label>
            <select id="category" name="category" class="select select-bordered w-full max-w-xs" required>
                @foreach ($categories as $category)
                    <option selected="{{ $product['category']->toString() == $category }}" value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>

            <button class="px-4 py-2 mt-8 w-full bg-white text-black hover:bg-zinc-300 rounded-xl">
                Save Changes
            </button>
        </form>
    </div>
@endsection
