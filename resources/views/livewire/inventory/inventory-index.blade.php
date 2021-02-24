<div class="grid h-full grid-cols-12" x-data="{showWarning:@entangle('showWarning').defer,showRestock:@entangle('showRestock').defer}">
    <div x-cloak x-show.transition.opacity="showWarning" class="fixed inset-0 z-50 grid place-items-center">
        <div @click.away="showWarning = false" class="relative w-1/4 p-5 text-center bg-white rounded">
            <i class="absolute text-red-600 cursor-pointer icofont-ui-close right-6" @click="showWarning = false"></i>
            <form wire:submit.prevent="updateThreshold()">
                <label class="text-sm font-semibold" for="warning">Warning quantity threshold for</label>
                <label class="block" for="warning">{{ $product->name ?? '' }}</label>
                <input wire:model="threshold" x-ref="warningInput" class="w-full rounded" placeholder="5" type="text" name="warning" id="warning">
                <h1 class="text-xs text-red-600">
                    @error('threshold')
                    {{ $message }}
                    @enderror
                </h1>
                <button class="w-full px-3 py-1 my-3 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                    <span>SAVE</span>
                </button>
            </form>
        </div>
    </div>
    <div x-cloak x-show.transition.opacity="showRestock" class="fixed inset-0 z-50 grid place-items-center">
        <div @click.away="showRestock = false" class="relative w-1/4 p-5 text-center bg-white rounded">
            <i class="absolute text-red-600 cursor-pointer icofont-ui-close right-6" @click="showRestock = false"></i>
            <form wire:submit.prevent="updateStock()">
                <label class="text-sm font-semibold" for="restock">ADD STOCKS FOR</label>
                <label class="block" for="restock">{{ $product->name ?? '' }}</label>
                <input autocomplete="off" wire:model="restock" x-ref="restockInput" class="w-full rounded" placeholder="5" type="text" name="restock" id="restock">
                <h1 class="text-xs text-red-600">
                    @error('restock')
                    {{ $message }}
                    @enderror
                </h1>
                <button class="w-full px-3 py-1 my-3 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                    <span>ADD STOCKS</span>
                </button>
            </form>
        </div>
    </div>
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
                <h1>Powered with &#x1F496; by J7 IT Solutions.</h1>
                <h1>All rights reserved. &copy; 2021</h1>
            </div>
        </div>
    </div>
    <div class="flex flex-col col-span-10 bg-red-200">
        <div class="flex justify-between px-5 py-2">
            <input wire:model="search" autofocus autocomplete="off" placeholder="Search for product..." class="w-1/2 rounded" type="text">
        </div>
        <div class="flex-grow w-full h-0 px-5 overflow-y-auto">
            <table class="table w-full text-sm text-center border border-gray-900 table-auto">
                <thead class="text-white">
                    <tr>
                        <th class="sticky top-0 w-auto p-2 font-medium bg-red-600 border border-gray-900">ID</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Name</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Stock</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Unit</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Last Restocked at</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Threshold</th>
                        <th class="sticky top-0 p-2 font-medium bg-red-600 border border-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($products as $product)
                    <tr wire:key="product-{{ $product->id }}">
                        <td class="p-2 border border-gray-900 ">{{ $product->id }}</td>
                        <td class="p-2 text-left border border-gray-900">{{ $product->name }}</td>
                        <td class="p-2 border border-gray-900 "><span>@if ($product->stock->quantity < $product->stock->warning)
                                    <i class="text-lg text-red-600 icofont-warning"></i>
                                    @endif</span>{{ $product->stock->quantity }}</td>
                        <td class="p-2 border border-gray-900 ">{{ $product->unit->name }}</td>
                        <td class="p-2 border border-gray-900 ">
                            <h1 class="text-sm italic">{{ $product->last_restock->format('M d, Y') }}</h1>
                            <h1 class="text-xs">{{ $product->last_restock->format('g:i a') }}</h1>
                        </td>
                        <td class="space-x-3 border border-gray-900">
                            <span>{{ $product->stock->warning }}</span>
                            <button @click="$nextTick(()=>{$refs.warningInput.focus();});" wire:click="showWarning({{ $product->id }})" class="px-3 py-1 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                                <i class="icofont-ui-edit"></i>
                            </button>
                        </td>
                        <td class="p-2 space-x-3 border border-gray-900">
                            <button @click="$nextTick(()=>{$refs.restockInput.focus();});" wire:click="showRestock({{ $product->id }})" class="px-3 py-1 text-white bg-green-400 rounded hover:text-gray-700 ring-2">
                                <i class="icofont-cubes"></i>
                                <span>RESTOCK</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
