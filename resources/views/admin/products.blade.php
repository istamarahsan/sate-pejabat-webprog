@extends("layouts.dashboard")

@section("child-content")
    <div class="mx-2 my-2 flex flex-col items-start">
        <h1 class="text-3xl font-black">Manage Products</h1>
        <div class="bg-zinc-800 rounded-md py-2 mt-4">
            <table class="table-auto text-left">
                <thead>
                    <tr>
                        <th class="font-thin px-4 py-2">Id</th>
                        <th class="font-thin px-4">Name</th>
                        <th class="font-thin px-4 py-2 flex flex-row items-end">Price <p class="ml-1 text-xs text-zinc-400">(Rp)</p></th>
                        <th class="font-thin px-4"><p class="px-3">Actions</p></th>
                        <th class="font-thin px-4"> </th>
                    </tr>
                </thead>
                <tbody>
                    @if( count($products) <= 0 )
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">Nobody but us chickens!</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900"></td>
                        </tr>
                    @endif
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900">1</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">Pecel Lele</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">500.000</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <a href="#" class="hover:bg-zinc-800 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Edit</a>
                            </td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                <a href="#" class="hover:bg-zinc-800 px-3 py-1 rounded-md transition-colors duration-200 font-bold">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection