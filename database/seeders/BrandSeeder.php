<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Xiaomi',
            'OPPO',
            'vivo',
            'realme',
            'Huawei',
            'Infinix',
            'TECNO',
            'Nothing',
            'Google Pixel',
            'OnePlus',
            'ASUS',
            'Sony',
            'Motorola',
            'Nokia',
            'Lenovo',
            'Honor',
            'ZTE',
            'RedMagic',
            'LG',
            'HTC',
            'Meizu',
            'Black Shark',
            'POCO',
            'HP',
            'Dell',
            'Acer',
            'MSI',
            'Gigabyte',
            'Razer',
            'Nintendo',
            'PlayStation',
            'Xbox'
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(['name' => $brandName]);
        }
    }
}
