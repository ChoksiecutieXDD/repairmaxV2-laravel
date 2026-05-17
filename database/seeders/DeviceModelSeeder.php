<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeviceModel;
use App\Models\Brand;

class DeviceModelSeeder extends Seeder
{
    public function run()
    {
        $modelMap = [
            'Apple' => [
                'iPhone XS', 'iPhone 11', 'iPhone 12', 'iPhone 13', 'iPhone 14', 'iPhone 15', 'iPhone 15 Pro Max'
            ],
            'Samsung' => [
                'Galaxy S21', 'Galaxy S22', 'Galaxy S23', 'Galaxy S24 Ultra', 'Galaxy A54'
            ],
            'Xiaomi' => [
                'Redmi Note 12', 'Redmi Note 13 Pro', 'Xiaomi 13', 'Xiaomi 14 Ultra'
            ],
            'OPPO' => [
                'Reno 10', 'Reno 11 Pro', 'Find X6'
            ],
            'vivo' => [
                'V27', 'V29 Pro', 'Y17s'
            ],
            'realme' => [
                'realme 11 Pro', 'realme C55', 'realme GT Neo 5'
            ],
            'Huawei' => [
                'Mate 50 Pro', 'Mate 60 Pro', 'P60 Pro'
            ],
            'Infinix' => [
                'Note 30', 'Zero 30', 'Hot 30i'
            ],
            'TECNO' => [
                'Camon 20', 'Pova 5', 'Spark 10 Pro'
            ],
            'Nothing' => [
                'Phone (1)', 'Phone (2)'
            ],
            'Google Pixel' => [
                'Pixel 6a', 'Pixel 7 Pro', 'Pixel 8 Pro'
            ],
            'OnePlus' => [
                'OnePlus 10 Pro', 'OnePlus 11', 'OnePlus 12'
            ],
            'ASUS' => [
                'ROG Phone 7', 'Zenfone 10'
            ],
            'Sony' => [
                'Xperia 1 V', 'Xperia 5 V'
            ],
            'Motorola' => [
                'Edge 40', 'Razr 40 Ultra'
            ],
            'Nokia' => [
                'Nokia G42', 'Nokia X30'
            ],
            'Lenovo' => [
                'Legion Y70'
            ],
            'Honor' => [
                'Honor 90', 'Honor Magic5 Pro'
            ],
            'ZTE' => [
                'Blade V50', 'Axon 50 Ultra'
            ],
            'RedMagic' => [
                'RedMagic 8S Pro', 'RedMagic 9 Pro'
            ]
        ];

        foreach ($modelMap as $brandName => $models) {
            $brand = Brand::where('name', $brandName)->first();
            if ($brand) {
                foreach ($models as $modelName) {
                    DeviceModel::firstOrCreate([
                        'brand_id' => $brand->id,
                        'name'     => $modelName,
                    ]);
                }
            }
        }
    }
}
