<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\DeviceModel;

class PhoneBrandAndModelSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple' => ['iPhone 15', 'iPhone 15 Pro', 'iPhone 15 Pro Max', 'iPhone 14', 'iPhone 14 Pro', 'iPhone 13', 'iPhone 12', 'iPhone 11', 'iPhone XS', 'iPhone X'],
            'Samsung' => ['Galaxy S24', 'Galaxy S24 Ultra', 'Galaxy A54', 'Galaxy A34', 'Galaxy Z Fold', 'Galaxy Z Flip', 'Galaxy Note 20', 'Galaxy S21', 'Galaxy S20'],
            'Xiaomi' => ['Xiaomi 14', 'Xiaomi 13', 'Xiaomi 12', 'Redmi Note 13', 'Redmi Note 12', 'Poco X5', 'Poco X4'],
            'Realme' => ['Realme 12', 'Realme 11', 'Realme 10', 'Realme 9', 'Realme 8', 'Realme GT'],
            'OPPO' => ['OPPO Find X6', 'OPPO Reno 10', 'OPPO A78', 'OPPO A54', 'OPPO A53'],
            'Vivo' => ['Vivo X90', 'Vivo Y36', 'Vivo Y35', 'Vivo V27', 'Vivo V25'],
            'Motorola' => ['Moto G54', 'Moto G53', 'Moto Edge 40', 'Moto G Stylus'],
            'OnePlus' => ['OnePlus 12', 'OnePlus 11', 'OnePlus 10', 'OnePlus 9'],
            'Google' => ['Pixel 8', 'Pixel 8 Pro', 'Pixel 7', 'Pixel 6'],
            'Nokia' => ['Nokia G42', 'Nokia G41', 'Nokia C32'],
        ];

        foreach ($brands as $brandName => $models) {
            $brand = Brand::firstOrCreate(
                ['name' => $brandName],
                ['is_active' => true]
            );

            foreach ($models as $modelName) {
                DeviceModel::firstOrCreate(
                    ['brand_id' => $brand->id, 'name' => $modelName],
                );
            }
        }

        $this->command->info('Phone brands and models seeded successfully!');
    }
}
