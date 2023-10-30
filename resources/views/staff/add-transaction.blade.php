@extends('layouts.staff')

@section('content')
    <form class="flex justify-center mx-auto pt-5 gap-4 flex-col items-center" x-data="transaction" method="post" action="{{ route('staff.storetransaction') }}">
        @csrf

        <div class="flex justify-start w-full">
            <button class="btn ounded-xl w-min" type="button">
                <div class="flex flex-row items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <p>Back</p>
                </div>
            </button>
        </div>
        <h1 class="text-3xl font-black flex flex-grow w-full items-baseline">Add a Transaction</h1>
        <p class="text-xs">{{ $success == 1 ? 'Success added transaction!' : '' }}</p>

        <div class="bg-zinc-800 rounded-md">
            <table class="table-auto text-left">
                <thead>
                    <tr>
                        <th class="font-thin px-4">Name</th>
                        <th>
                            <div class="font-thin px-4 py-2 flex flex-wrap items-end">
                                Unit Price
                                <p class="ml-1 text-xs text-zinc-400">(Rp)</p>
                            </div>
                        </th>
                        <th class="font-thin px-4 py-2 flex flex-wrap items-end">
                            Price
                            <p class="ml-1 text-xs text-zinc-400">(Rp)</p>
                        </th>
                        <th class="font-thin px-4">Quantity</th>
                        <th x-show="Object.keys(items).length > 0" class="font-thin px-4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr x-show="Object.keys(items).length <= 0">
                        <td colspan="4" class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">Nobody but us chickens!</td>
                    </tr>
                    <template x-for="itemProductId in Object.keys(items)">
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="getProductData(itemProductId).name"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="getProductData(itemProductId).price"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="getProductData(itemProductId).price"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                                <input class="input input-bordered w-20 text-center" :value="1" :name="`item-${itemProductId}`" :id="`item-${itemProductId}`" type="number" required />
                            </td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">todo: add delete</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div x-show="availableProductIds().length > 0" class="flex flex-row items-center justify-center">
            <select class="text-black" id="product-select" @change="selectedProductId = $el.options[$el.selectedIndex].value" x-init="$watch('items', (_value) => {
                if (availableProductIds().length === 0) {
                    return;
                }
                $el.selectedIndex = 0;
                selectedProductId = $el.options[$el.selectedIndex].value;
            })">
                <template x-for="productId in availableProductIds()">
                    <option :value="productId" x-text="getProductData(productId).name">

                    </option>
                </template>
            </select>
            <button type="button" @click="items[selectedProductId] = 0;" class="py-2 px-4 rounded-xl bg-zinc-600">
                Add
            </button>
        </div>

        <div class="flex justify-end w-full items-end">
            <button x-bind:disabled="Object.keys(items).length <= 0" class="btn btn-primary py-2 px-4 rounded-xl w-min" type="submit">Finalize</button>
        </div>
    </form>
    <script>
        const productsData = {
            @foreach ($products as $product)
                {{ $product['id'] }}: {
                    id: {{ $product['id'] }},
                    name: '{{ $product['name'] }}',
                    price: {{ $product['price'] }},
                    category: '{{ $product['category']->toString() }}'
                },
            @endforeach
        }
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('transaction', () => ({
                selectedProductId: Object.keys(productsData)[0] ?? 0,
                items: {},
                availableProductIds() {
                    return Object.keys(productsData).filter(
                        (e) => !(e in this.items))
                },
                getProductData(id) {
                    return productsData[id]
                }
            }))
        })
    </script>
@endsection
