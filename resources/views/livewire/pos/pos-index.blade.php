<div x-data="{payment : @entangle('paymentModal').defer}" x-on:print-invoice="window.open('/invoice/' + $event.detail.transaction);" class="grid w-full h-full grid-cols-2 gap-4">
    <div wire:loading.grid class="fixed inset-0 z-50 grid place-items-center">
        <i class="text-7xl icofont-spinner animate-spin"></i>
    </div>
    <div x-show.transition="payment" x-cloak class="fixed inset-0 z-30 grid bg-gray-300 bg-opacity-70 place-items-center">
        <div @click.away="payment=false" class="relative flex flex-col items-center w-1/2 p-5 bg-white rounded-lg">
            <i class="absolute text-red-600 cursor-pointer icofont-ui-close right-6" @click="payment = false"></i>
            <h1 class="text-xl font-semibold uppercase">Payment</h1>
            <br>
            <h1>Amount Due:</h1>
            <h1>&#8369; {{ number_format($transaction->sales,2) }}</h1>
            <br>
            <h1>Amount Tendered:</h1>
            <form wire:submit.prevent="finalizeTransaction" class="flex flex-col items-center w-full">
                <div class="flex items-center justify-center w-full space-x-2">
                    <i class="text-xl icofont-peso"></i><input placeholder="0.00" x-ref="payment_input" wire:model.defer="amount_tendered" type="text" class="w-3/4 border-none rounded ring-2">
                </div>
                <h1 class="text-xs text-red-600">@error('amount_tendered')
                    {{ $message }}
                    @enderror</h1>
                <div class="flex flex-col my-2 space-y-2">
                    <button type="submit" class="inline-block w-full text-white bg-green-600 button">Finish</button>
                    <button wire:click="printInvoice" type="button" class="inline-block w-full text-white bg-yellow-600 button">Finish and Print Invoice</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="text-center">
            <input x-ref="productSearch" type="text" wire:model="query" autofocus placeholder="Search for products..." autocomplete="off" class="w-full rounded-md">
        </div>
        <div id="products-container" class="mx-auto mt-2 overflow-y-auto bg-red-300 divide-y-2 divide-gray-500 h-72">
            <div class="sticky top-0 flex justify-between p-2 font-semibold text-center text-white bg-red-600">
                <div class="w-2/5">
                    <h1>Product</h1>
                </div>
                <div class="w-1/5">
                    <h1>Stocks</h1>
                </div>
                <div class="w-1/5">
                    <h1>Unit</h1>
                </div>
                <div class="w-1/5">
                    <h1>Price</h1>
                </div>
            </div>
            @forelse ($products as $product)
            <div @click="$nextTick(()=>{$refs.productSearch.focus();})" wire:key="product-{{ $product->id }}" wire:click="selectProduct({{ $product }})" class="flex justify-between p-2 cursor-pointer hover:bg-gray-200">
                <div class="w-2/5 break-words">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-center">{{ $transaction->products->where('id',$product->id)->first() ? $product->items_instock - $transaction->products->where('id',$product->id)->first()->pivot->quantity :  $product->items_instock}}</h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-center">{{ $product->items_instock > 1 ? $product->unit->plural : $product->unit->name }}</h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-center">&#8369;{{ number_format($product->srp,2) }}</h1>
                </div>
            </div>
            @empty
            <div>
                <h1 class="text-center">No products found matching the searched text.</h1>
            </div>
            @endforelse
        </div>
        <div class="p-3 my-3 text-xl bg-gray-200">
            <h1 class="text-xl font-semibold text-center uppercase">Sale Summary</h1>
            <div>
                <h1><i class="mr-2 text-green-600 icofont-money"></i>Total Sales: &#8369; <span class="font-semibold">{{ number_format($transaction->sales,2) }}</span></h1>
                <h1><i class="mr-2 text-red-600 icofont-sale-discount"></i>Total Discount: &#8369; <span class="font-semibold">{{ number_format($transaction->discount,2) }}</span></h1>
                <h1><i class="mr-2 text-blue-600 icofont-chart-pie-alt text-ora"></i>Quantity: {{ $transaction->total_quantity }} ({{ $transaction->total_units }})</h1>
            </div>
        </div>
    </div>
    <div class="relative flex flex-col h-full p-2 bg-red-300">
        <i class="absolute text-xl text-red-600 cursor-pointer icofont-ui-close top-2 right-2" wire:click="discardTransaction"></i>
        <h1 class="text-xl font-semibold text-center uppercase">Current Sale</h1>
        <div class="flex flex-col justify-between flex-1">
            <div class="h-64 overflow-y-auto bg-white">
                <table class="w-full text-sm text-center border-2 border-collapse divide-y-2 table-auto">
                    <thead class="text-white">
                        <tr>
                            <th class="sticky top-0 z-20 bg-red-500">Product</th>
                            <th class="sticky top-0 z-20 bg-red-500">Price</th>
                            <th class="sticky top-0 z-20 bg-red-500">Sell Price</th>
                            <th class="sticky top-0 z-20 bg-red-500">Quantity</th>
                            <th class="sticky top-0 z-20 bg-red-500">Unit</th>
                            <th class="sticky top-0 z-20 bg-red-500">Sub-total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2">
                        @forelse ($transaction->products as $sold_product)
                        <tr>
                            <td class="w-2/5">
                                <div class="flex items-center p-2 space-x-2 text-left break-all"><i wire:click="removeProduct({{ $sold_product->pivot->id }})" class="text-red-600 cursor-pointer icofont-ui-close"></i><span class="inline-block">{{ $sold_product->name }}</span></div>
                            </td>
                            <td>&#8369; {{ number_format($sold_product->srp,2) }}</td>
                            <td>&#8369; {{ number_format($sold_product->pivot->sell_price,2) }}</td>
                            <td>{{ $sold_product->pivot->quantity }}</td>
                            <td>{{ $sold_product->pivot->quantity > 1 ? $sold_product->unit->plural : $sold_product->unit->name }}</td>
                            <td>&#8369; {{ number_format($sold_product->pivot->subtotal,2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="p-5 text-center" colspan="6">Add a product...</td>
                        </tr>
                        <tr>
                            <td class="p-5 text-center" colspan="6">
                                <i class="text-9xl icofont-bar-code"></i>
                                <i class="text-9xl icofont-sale-discount"></i>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($selected_product)
            <div class="p-3 space-y-4 bg-white border-2">
                <h1 class="font-medium text-center">{{ $selected_product->name }}</h1>
                <div class="justify-around center">
                    <h1>Price: &#8369;{{ number_format($selected_product->srp,2) }}</h1>
                    <h1>Stocks: {{ $selected_product->stock->quantity }} {{ $selected_product->stock->quantity > 1 ? $selected_product->unit->plural : $selected_product->unit->name }} remaining</h1>
                </div>
                <div class="justify-around center">
                    <h1 class="flex items-center"><span class="mr-1">Quantity: </span><input type="number" wire:model.lazy="selected_quantity" class="text-xs text-center"></h1>
                    <h1 class="flex items-center"><span class="mr-1">Sell Price: &#8369;</span><input type="number" wire:model.lazy="selected_price" class="text-xs text-center"></h1>
                </div>
                <div class="justify-between center">
                    <div class="space-x-2">
                        <button wire:click="applyDiscount" class="text-white bg-gray-600 button ring-4 ring-gray-400">Apply Discount</button>
                        <input type="number" class="w-24" wire:model.lazy="discount"><span>%</span>
                    </div>
                    <div class="space-x-3">
                        <button @click="$nextTick(()=>{$refs.productSearch.focus();})" wire:click="addToSale" class="text-white bg-gray-600 button ring-4 ring-gray-400">Add to Sale</button>
                        <button @click="$nextTick(()=>{$refs.productSearch.focus();})" wire:click="cancelAddToSale" class="text-white bg-red-400 button ring-4 ring-red-300">Cancel</button>
                    </div>
                </div>
            </div>
            @else
            <h1 class="text-center">Please select or search for a product.</h1>
            @endif
            <div class="my-2">
                <button @click="$nextTick(()=>$refs.payment_input.focus()); payment = true;" class="inline-block w-full text-white bg-green-600 button">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', () => {
        const productContainer = document.querySelector('#products-container');
        productContainer.onscroll = (e) => {
            if (e.target.clientHeight + e.target.scrollTop + 1 > e.target.scrollHeight)
                Livewire.emit('loadMore');
        }
    });

</script>
@endpush
