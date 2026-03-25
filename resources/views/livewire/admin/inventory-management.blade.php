<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory Management</h1>
            <p class="text-gray-500 mt-1">Add, edit, and manage inventory items.</p>
        </div>
        <button wire:click="createItem" class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add Item
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <h2 class="text-lg font-bold text-gray-900 mb-4">{{ $isEdit ? 'Edit Item' : 'Add Item' }}</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Item Name</label>
                    <input wire:model.defer="name" type="text" class="mt-1 block w-full p-2 border rounded-md" placeholder="Item name" />
                    @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <input wire:model.defer="category" type="text" class="mt-1 block w-full p-2 border rounded-md" placeholder="Category" />
                    @error('category') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">SKU</label>
                    <input wire:model.defer="sku" type="text" class="mt-1 block w-full p-2 border rounded-md" placeholder="SKU" />
                    @error('sku') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input wire:model.defer="quantity" type="number" min="0" class="mt-1 block w-full p-2 border rounded-md" />
                        @error('quantity') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Unit Price</label>
                        <input wire:model.defer="unit_price" type="number" step="0.01" min="0" class="mt-1 block w-full p-2 border rounded-md" />
                        @error('unit_price') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex gap-2">
                    <button wire:click="saveItem" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">{{ $isEdit ? 'Update' : 'Save' }}</button>
                    <button wire:click="resetInventoryForm" class="bg-gray-200 hover:bg-gray-300 text-gray-900 px-4 py-2 rounded-lg">Clear</button>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input wire:model="search" type="text" class="mt-2 block w-full p-2 border rounded-md" placeholder="Search by name, category, SKU" />

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-3 py-2">Item</th>
                            <th class="px-3 py-2">SKU</th>
                            <th class="px-3 py-2">Stock</th>
                            <th class="px-3 py-2">Unit</th>
                            <th class="px-3 py-2">Value</th>
                            <th class="px-3 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $item->name }}</td>
                                <td class="px-3 py-2">{{ $item->sku }}</td>
                                <td class="px-3 py-2">{{ $item->quantity }}</td>
                                @php
                                    $unitDecimals = fmod($item->unit_price, 1) > 0 ? 2 : 0;
                                    $totalItemDecimals = fmod($item->total_value, 1) > 0 ? 2 : 0;
                                @endphp
                                <td class="px-3 py-2">₱{{ number_format($item->unit_price, $unitDecimals, '.', ',') }}</td>
                                <td class="px-3 py-2">₱{{ number_format($item->total_value, $totalItemDecimals, '.', ',') }}</td>
                                <td class="px-3 py-2">
                                    <button wire:click="editItem({{ $item->id }})" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</button>
                                    <button wire:click="deleteItem({{ $item->id }})" class="text-red-600 hover:text-red-800 text-xs font-medium ml-2">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-gray-500">No items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
