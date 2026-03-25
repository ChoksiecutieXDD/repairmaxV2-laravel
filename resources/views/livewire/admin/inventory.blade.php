<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory</h1>
            <p class="text-gray-500 mt-1">Track repair parts and equipment stock levels.</p>
        </div>
        <a href="{{ route('admin.inventory-management') }}" class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
            <span class="material-symbols-outlined text-[20px]">edit</span>
            Manage Inventory
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Items</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalItems }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                </div>
            </div>
            <p class="text-sm text-blue-600 font-medium">SKU items in stock</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Low Stock</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $lowStock }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
            </div>
            <p class="text-sm text-yellow-600 font-medium">Items need reorder</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Out of Stock</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $outOfStock }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">block</span>
                </div>
            </div>
            <p class="text-sm text-red-600 font-medium">Critical attention</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Value</p>
                    @php
                        $priceDecimals = fmod($totalValue, 1) > 0 ? 2 : 0;
                        $displayTotalValue = number_format($totalValue, $priceDecimals, '.', ',');
                    @endphp
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">₱{{ $displayTotalValue }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">attach_money</span>
                </div>
            </div>
            <p class="text-sm text-green-600 font-medium">Total inventory value</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Inventory Items</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Item Name</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Unit Price</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php
                        $items = \App\Models\InventoryItem::orderBy('name')->take(6)->get();
                    @endphp
                    @forelse ($items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4"><span class="font-medium text-gray-900">{{ $item->name }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $item->category }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $item->sku }}</span></td>
                            <td class="px-6 py-4"><span class="font-medium text-gray-900">{{ $item->quantity }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">₱{{ number_format($item->unit_price, 2) }}</span></td>
                            <td class="px-6 py-4">
                                @if($item->quantity <= 0)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-700 border border-red-100 rounded-lg text-xs font-bold">Out of Stock</span>
                                @elseif($item->quantity <= 10)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-lg text-xs font-bold">Low Stock</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">In Stock</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No inventory items available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
