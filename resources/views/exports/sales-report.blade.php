<table class="table w-full text-center table-auto">
    <thead class="text-white">
        <tr>
            <th class="sticky top-0 w-auto p-2 font-medium bg-yellow-600">Transaction Code</th>
            <th class="sticky top-0 p-2 font-medium bg-yellow-600">Date</th>
            <th class="sticky top-0 p-2 font-medium bg-yellow-600">Products</th>
            <th class="sticky top-0 p-2 font-medium bg-yellow-600">Quantity</th>
            <th class="sticky top-0 p-2 font-medium bg-yellow-600">Price</th>
            <th class="sticky top-0 p-2 font-medium bg-yellow-600">Total Sales</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transactions as $transaction)
        <tr>
            <td class="p-2">{{ $transaction->code }}</td>
            <td class="p-2">{{ $transaction->date_for_humans }}</td>
            <td class="p-2">
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
                <h1 class="text-sm">&#8369; {{ number_format($product->pivot->sell_price,2) }}</h1>
                @endforeach
            </td>
            <td class="p-2 space-x-3">
                <h1 class="text-sm">&#8369; {{ number_format($transaction->total_sales,2) }}</h1>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-2 text-center">No transactions for this date range.</td>
        </tr>
        @endforelse
    </tbody>
</table>
