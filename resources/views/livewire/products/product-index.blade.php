<div class="grid h-full grid-cols-12" x-data="{ createModal : @entangle('showCreate').defer }" x-init="console.log(123)">
    <div x-show.transition.opacity="createModal" x-cloak class="fixed inset-0 z-50 grid bg-gray-200 bg-opacity-50 place-items-center">
        <div @click.away="createModal = false" class="w-1/2 p-5 space-y-5 bg-white">
            <h1 class="font-semibold text-center">ADD A NEW PRODUCT</h1>
            <form wire:submit.prevent="addProduct" class="space-y-3">
                <div>
                    <label for="name">Product Name</label>
                    <input wire:model.defer="product_name" x-ref="product_name" autocomplete="off" name="name" id="name" type="text" class="w-full rounded" placeholder="Product name...">
                    <h1 class="text-xs text-red-600">
                        @error('product_name')
                        {{ $message }}
                        @enderror
                    </h1>
                </div>
                <div>
                    <label for="srp">Product SRP</label>
                    <input wire:model.defer="product_srp" x-ref="product_srp" autocomplete="off" name="srp" id="srp" type="text" class="w-full rounded" placeholder="0.00">
                    <h1 class="text-xs text-red-600">
                        @error('product_srp')
                        {{ $message }}
                        @enderror
                    </h1>
                </div>
                <div>
                    <label for="unit">Product Unit</label>
                    <select wire:model="product_unit" name="unit" id="unit" class="block w-full rounded">
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($editing)
                <button class="p-2 bg-green-400 rounded hover:bg-opacity-50">SAVE PRODUCT</button>
                @else
                <button class="p-2 bg-green-400 rounded hover:bg-opacity-50">ADD PRODUCT</button>
                @endif
            </form>
        </div>
    </div>
    <div class="col-span-2 p-5 bg-gray-400">
        <div class="flex flex-col h-full">
            <ul class="flex flex-col flex-grow space-y-3 font-semibold uppercase">
                <a class="p-2 duration-200 rounded {{ session('page') == 'products.index' ? 'bg-gray-700 text-white' : '' }} hover:bg-gray-700 hover:text-white" href="{{ route('products.index') }}">
                    <li>Products</li>
                </a>
                <a class="p-2 duration-200 rounded {{ session('page') == 'inventory.index' ? 'bg-gray-700 text-white' : '' }} hover:bg-gray-700 hover:text-white" href="{{ route('inventory.index') }}">
                    <li>Inventory</li>
                </a>
                <a class="p-2 duration-200 rounded {{ session('page') == 'reports.index' ? 'bg-gray-700 text-white' : '' }} hover:bg-gray-700 hover:text-white" href="{{ route('reports.index') }}">
                    <li>Reports</li>
                </a>
            </ul>
            <div class="text-xs text-center">
                <h1>Powered with &#x1F496; by J7 IT Solutions.</h1>
                <h1>All rights reserved. &copy; 2021</h1>
            </div>
        </div>
    </div>
    <div class="flex flex-col col-span-10 bg-gray-300">
        <div class="flex justify-between px-5 py-2">
            <input wire:model="search" autofocus autocomplete="off" placeholder="Search for product..." class="w-1/2 rounded" type="text">
            <button @click="createModal = true; $nextTick(()=>{$refs.product_name.focus();});" class="px-3 py-2 bg-green-400 rounded hover:bg-opacity-50">ADD PRODUCT</button>
        </div>
        <div class="flex-grow w-full h-0 px-5 overflow-y-auto">
            <table class="table w-full text-center table-auto">
                <thead class="text-white">
                    <tr>
                        <th class="sticky top-0 w-auto p-2 font-medium bg-yellow-600">ID</th>
                        <th class="sticky top-0 p-2 font-medium bg-yellow-600">Name</th>
                        <th class="sticky top-0 p-2 font-medium bg-yellow-600">SRP</th>
                        <th class="sticky top-0 p-2 font-medium bg-yellow-600">Unit</th>
                        <th class="sticky top-0 p-2 font-medium bg-yellow-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="p-2 ">{{ $product->id }}</td>
                        <td class="p-2 text-left">{{ $product->name }}</td>
                        <td class="p-2">&#8369; {{ number_format($product->srp,2) }}</td>
                        <td class="p-2 ">{{ $product->unit->name }}</td>
                        <td class="p-2 space-x-3">
                            <button wire:click="showEdit({{ $product->id }})" class="px-3 py-1 bg-green-400 rounded ring-2">
                                <i class="icofont-ui-edit"></i>
                            </button>
                            <button wire:click="deleteProduct({{ $product->id }})" class="px-3 py-1 bg-red-600 rounded ring-2">
                                <i class="icofont-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
