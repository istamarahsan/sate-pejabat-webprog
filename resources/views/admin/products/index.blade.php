@extends('layouts.dashboard')

@section('child-content')
    <div class="mx-2 my-2 flex flex-col items-start">
        <h1 class="text-3xl font-black flex flex-grow w-full items-baseline">Manage Products
            <a class="ml-auto" href="{{ route('admin.products.create') }}">
                <div class="ml-2 py-1 px-2 rounded-lg text-sm text-center align-middle bg-black text-white hover:bg-zinc-700 transition-colors duration-200">
                    New Product
                </div>
            </a>
        </h1>
        <div class="bg-zinc-800 rounded-md py-2 mt-4">
            <table class="table-auto text-left">
                <thead>
                    <tr>
                        <th class="font-thin px-4 py-2">Id</th>
                        <th class="font-thin px-4">Name</th>
                        <th class="font-thin px-4 py-2 flex flex-row items-end">
                            Price
                            <p class="ml-1 text-xs text-zinc-400">(Rp)</p>
                        </th>
                        <th class="font-thin px-4">Category</th>
                        <th class="font-thin px-4"></th>
                        <th class="font-thin px-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) <= 0)
                        <tr>
                            <td colspan="6" class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">Nobody but us chickens!</td>
                        </tr>
                    @endif
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900">{{ $product['id'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $product['name'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ number_format($product['price']) }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">{{ $product['category']->toString() }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <a href="{{ route('admin.products.edit', ['product' => $product['id']]) }}" class="hover:bg-zinc-800 bg-zinc-950 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Edit</a>
                            </td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <form method="post" action="{{ route('admin.products.destroy', ['product' => $product['id']]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure to delete {{ $product['name'] }} ?')" class="hover:bg-zinc-800 bg-zinc-950 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
