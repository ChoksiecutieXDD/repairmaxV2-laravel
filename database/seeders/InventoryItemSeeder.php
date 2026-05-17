<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use App\Models\Brand;

class InventoryItemSeeder extends Seeder
{
    public function run()
    {
        $apple = Brand::where('name', 'Apple')->first();
        $samsung = Brand::where('name', 'Samsung')->first();

        $items = [
            [
                'brand_id'   => $apple ? $apple->id : null,
                'name'       => 'iPhone Screen Replacement',
                'category'   => 'Screens',
                'sku'        => 'SKU-IPH-SCR',
                'quantity'   => 45,
                'unit_price' => 2500
            ],
            [
                'brand_id'   => $samsung ? $samsung->id : null,
                'name'       => 'Galaxy Battery Replacement',
                'category'   => 'Batteries',
                'sku'        => 'SKU-GAL-BAT',
                'quantity'   => 18,
                'unit_price' => 950
            ],
            [
                'brand_id'   => $apple ? $apple->id : null,
                'name'       => 'MacBook Keyboard Assembly',
                'category'   => 'Keyboards',
                'sku'        => 'SKU-MAC-KBD',
                'quantity'   => 15,
                'unit_price' => 3500
            ],
        ];

        foreach ($items as $item) {
            InventoryItem::updateOrCreate(['sku' => $item['sku']], $item);
        }
    }
}
