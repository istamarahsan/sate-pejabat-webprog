@extends('layouts.app')

@section('content')
    <form class="flex justify-center p-10" x-data="transaction" method="post"
        action="{{ route('staff.storetransaction') }}">
        @csrf
        <div class="flex flex-col items-stretch gap-10 max-w-4xl">
            <div class="flex flex-col gap-2">
                <template x-for="itemProductId in Object.keys(items)">
                    <div class="grid grid-cols-2">
                        <div class="text-left flex items-center">
                            <span x-text="getProductData(itemProductId).name">

                            </span>
                        </div>
                        <input class="text-black" :name="`item-${itemProductId}`"
                            :id="`item-${itemProductId}`" type="number" required />
                    </div>
                </template>
            </div>
            <div x-show="availableProductIds().length > 0"
                class="flex flex-row items-center justify-center gap-5">
                <select class="text-black" id="product-select"
                    @change="selectedProductId = $el.options[$el.selectedIndex].value"
                    x-init="$watch('items', (_value) => {
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
                <button type="button" @click="items[selectedProductId] = 0;"
                    class="py-2 px-4 rounded-xl bg-zinc-600">
                    Add
                </button>
            </div>
            <div class="flex justify-center">
                <button class="py-2 px-4 rounded-xl bg-zinc-600 w-min" type="submit">Finalize</button>
            </div>
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
