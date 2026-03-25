<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;

class InventoryItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['name' => 'iPhone Screen', 'category' => 'Screens', 'sku' => 'SKU-IP14-SCR', 'quantity' => 45, 'unit_price' => 2500],
            ['name' => 'Galaxy Battery', 'category' => 'Batteries', 'sku' => 'SKU-GS23-BAT', 'quantity' => 8, 'unit_price' => 950],
            ['name' => 'MacBook Keyboard', 'category' => 'Keyboards', 'sku' => 'SKU-MBPR-KBD', 'quantity' => 15, 'unit_price' => 3500],
            ['name' => 'PS5 Controller', 'category' => 'Accessories', 'sku' => 'SKU-PS5-CTR', 'quantity' => 22, 'unit_price' => 3200],
        ];

        foreach ($items as $item) {
            InventoryItem::updateOrCreate(['sku' => $item['sku']], $item);
        }
    }
}
