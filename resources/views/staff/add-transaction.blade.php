@extends('layouts.staff')

@section('content')
    <form class="flex justify-center mx-auto pt-5 gap-4 flex-col items-center" x-data="transaction" method="post" action="{{ route('staff.storetransaction') }}">
        @csrf

        <div class="flex justify-start w-full">
            <a class="btn ounded-xl w-min" type="button" href="{{ route('staff.home') }}">
                <div class="flex flex-row items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <p>Back</p>
                </div>
            </a>
        </div>
        <h1 class="text-3xl font-black flex flex-grow w-full items-baseline">Add a Transaction</h1>
        @if (session()->has('success'))
            <div x-data="{ show: @js(session()->has('success')) }" x-show="show" class="alert shadow-lg absolute bottom-5 right-5 w-1/3 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-bold">Successfully added transaction!</h3>
                    <div class="text-xs">You have added {{ session('quantity') }} items.</div>
                </div>
                <button type="button" x-on:click="show = false;" class="btn btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

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
                        <th class="font-thin px-4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr x-show="Object.keys(items).length <= 0">
                        <td colspan="5" class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">Nobody but us chickens!</td>
                    </tr>
                    <template x-for="(value, itemProductId) in items" :key="itemProductId">
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="getProductData(itemProductId).name"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="formatInteger.format(getProductData(itemProductId).price)"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400" x-text="formatInteger.format(getProductData(itemProductId).price * items[itemProductId])"></td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                                <input class="input input-bordered w-20 text-center" :value="1" :name="`item-${itemProductId}`" :id="`item-${itemProductId}`" type="number" @input="items[itemProductId] = $el.value" required />
                            </td>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                                <button type="button" @click="delete items[itemProductId]" class="btn btn-sm btn-warning">
                                    DELETE
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div x-show="availableProductIds().length > 0" class="flex flex-row gap-2 justify-end w-full">
            <select class="select select-bordered w-1/2" id="product-select" @change="selectedProductId = $el.options[$el.selectedIndex].value" x-init="$watch('items', (_value) => {
                if (availableProductIds().length === 0) {
                    return;
                }
                $el.selectedIndex = 0;
                selectedProductId = $el.options[$el.selectedIndex].value;
            })">
                <template x-for="productId in availableProductIds()">
                    <option :value="productId" x-text="getProductData(productId).name"></option>
                </template>
            </select>
            <button type="button" @click="items[selectedProductId] = 1;" class="btn btn-neutral">
                Add
            </button>
        </div>

        <div class="flex justify-end w-full items-end">
            <button x-bind:disabled="Object.keys(items).length <= 0" class="btn btn-primary flex flex-row" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                <p>Add Transaction</p>
            </button>
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
        const formatInteger = new Intl.NumberFormat('en-ID');

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
