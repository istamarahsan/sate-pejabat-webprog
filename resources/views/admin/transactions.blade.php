@extends('layouts.dashboard')

@section('child-content')
    <div class="mx-2 my-2 flex flex-col items-start">
        <h1 class="text-3xl font-black flex flex-grow w-full items-baseline">Transactions</h1>
        <div class="bg-zinc-800 rounded-md py-2 mt-4">
            <table class="table-auto text-left">
                <thead>
                    <tr>
                        <th class="font-thin px-4 py-2">Id</th>
                        <th class="font-thin px-4 py-2">Staff Id</th>
                        <th class="font-thin px-4">Date</th>
                        <th class="font-thin px-4 py-2 flex flex-row items-end">
                            Total Sale
                            <p class="ml-1 text-xs text-zinc-400">(Rp)</p>
                        </th>
                        <th class="font-thin px-4">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($transactions) <= 0)
                        <tr>
                            <td colspan="6" class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900 text-zinc-400">
                                Nobody but us chickens!</td>
                        </tr>
                    @endif
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td class="px-4 py-2 border border-zinc-600 border-x-0 bg-zinc-900">
                                {{ $transaction['id'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                {{ $transaction['handlerId'] }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                {{ $transaction['date']->toDateString() }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                {{ number_format($transaction['totalSale']) }}</td>
                            <td class="px-4 border border-zinc-600 border-x-0 bg-zinc-900">
                                {{ $transaction['notes'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
