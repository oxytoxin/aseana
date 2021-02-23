<div class="grid h-full grid-cols-12">
    <x-loading wire:loading.grid wire:target="export" />
    <div class="col-span-2 p-5 bg-red-400">
        <div class="flex flex-col h-full">
            <ul class="flex flex-col flex-grow space-y-3 font-semibold uppercase">
                <a class="p-2 duration-200 rounded {{ session('page') == 'products.index' ? 'bg-red-700 text-white' : '' }} hover:bg-red-700 hover:text-white" href="{{ route('products.index') }}">
                    <li>Products</li>
                </a>
                <a class="p-2 duration-200 rounded {{ session('page') == 'inventory.index' ? 'bg-red-700 text-white' : '' }} hover:bg-red-700 hover:text-white" href="{{ route('inventory.index') }}">
                    <li>Inventory</li>
                </a>
                <a class="p-2 duration-200 rounded {{ session('page') == 'reports.index' ? 'bg-red-700 text-white' : '' }} hover:bg-red-700 hover:text-white" href="{{ route('reports.index') }}">
                    <li>Reports</li>
                </a>
            </ul>
            <div class="text-xs text-center">
                <h1 wire:click="show">Powered with &#x1F496; by J7 IT Solutions.</h1>
                <h1>All rights reserved. &copy; 2021</h1>
            </div>
        </div>
    </div>
    <div class="flex flex-col col-span-10 bg-red-200">
        <div class="flex px-5 py-2 space-x-3">
            <input wire:ignore x-data x-init="
            new Pikaday({ field: $refs.date_from });
        " wire:model.lazy="date_from" x-ref="date_from" type="text">
            <input wire:ignore x-data x-init="
            new Pikaday({ field: $refs.date_to });
        " wire:model.lazy="date_to" x-ref="date_to" type="text">
            <button wire:click="export" class="px-3 py-1 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                <span><i class="mr-2 icofont-file-excel"></i>EXPORT</span>
            </button>
            <button wire:click="printReport" class="px-3 py-1 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                <span><i class="mr-2 icofont-print"></i>PRINT</span>
            </button>
        </div>
        <div class="flex-grow w-full h-0 px-5 overflow-y-auto">
            <table class="table w-full text-sm text-center table-auto">
                <thead class="text-white">
                    <tr>
                        <th class="sticky top-0 w-auto p-2 font-medium bg-red-600">Transaction Code</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Date</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Products</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Quantity</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">SRP</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Sell Price</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Discount</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600">Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td class="p-2">{{ $transaction->code }}</td>
                        <td class="p-2">{{ $transaction->date_for_humans }}</td>
                        <td class="p-2 w-96">
                            @foreach ($transaction->products as $product)
                            <h1 class="text-sm">{{ $product->name }}</h1>
                            @endforeach
                        </td>
                        <td class="p-2 ">
                            @foreach ($transaction->products as $product)
                            <h1>{{$product->pivot->quantity }}</h1>
                            @endforeach
                        </td>
                        <td class="p-2 ">
                            @foreach ($transaction->products as $product)
                            <h1 class="text-sm">&#8369; {{ number_format($product->srp,2) }}</h1>
                            @endforeach
                        </td>
                        <td class="p-2 ">
                            @foreach ($transaction->products as $product)
                            <h1 class="text-sm">&#8369; {{ number_format($product->pivot->sell_price,2) }}</h1>
                            @endforeach
                        </td>
                        <td class="p-2 ">
                            @foreach ($transaction->products as $product)
                            <h1 class="text-sm">&#8369; {{ number_format($product->pivot->discount,2) }}</h1>
                            @endforeach
                        </td>
                        <td class="p-2 space-x-3">
                            <h1 class="text-sm">&#8369; {{ number_format($transaction->total_sales,2) }}</h1>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="p-2 text-center">No transactions for this date range.</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="4" class="p-2 text-center border border-gray-900">Grand Total Sales</td>
                        <td colspan="4" class="p-2 text-center border border-gray-900">&#8369; {{ number_format($transactions->sum('total_sales'),2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
