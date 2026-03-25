<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Inventory Management</h1>
            <p class="text-gray-600 mt-1">Add, update, or remove inventory items and manage reorder levels.</p>
        </div>
        <button wire:click="$set('showAddForm', true)" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors flex items-center gap-2 shadow-md">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add Item
        </button>
    </div>

    @if($showAddForm)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Add New Item</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Item Name</label>
                    <input type="text" wire:model="itemName" placeholder="e.g., iPhone Screen" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                    <select wire:model="category" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">Select Category</option>
                        <option value="Parts">Parts</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Tools">Tools</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Quantity</label>
                    <input type="number" wire:model="quantity" placeholder="0" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Unit Price (₱)</label>
                    <input type="number" wire:model="unitPrice" placeholder="0.00" step="0.01" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button wire:click="addItem" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Save Item
                </button>
                <button wire:click="$set('showAddForm', false)" class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Unit Price</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Reorder Level</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Supplier</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($inventory as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-900 text-sm">{{ $item['item'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['category'] }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $item['quantity'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['unit_price'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['reorder_level'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['supplier'] }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <button class="p-2 hover:bg-blue-50 text-blue-600 rounded-lg transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-red-50 text-red-600 rounded-lg transition-colors" title="Delete">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <p class="font-medium">No items in inventory</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
