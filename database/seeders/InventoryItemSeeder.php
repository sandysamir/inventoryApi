<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventoryItem;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         InventoryItem::insert([
            ['name' => 'iPhone 15 Pro', 'SKU' => 'IP15P-001', 'description' => 'Apple smartphone, 256GB, Titanium', 'price' => 45999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy S24', 'SKU' => 'SGS24-002', 'description' => 'Samsung smartphone, 128GB, Black', 'price' => 38999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dell XPS 13 Laptop', 'SKU' => 'DELLX13-003', 'description' => 'Intel i7, 16GB RAM, 512GB SSD', 'price' => 62999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Logitech Mouse MX', 'SKU' => 'LOGMX-004', 'description' => 'Wireless ergonomic mouse', 'price' => 1999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple MacBook Air M3', 'SKU' => 'MBA13M3-005', 'description' => '13-inch, 8-core CPU, 256GB SSD', 'price' => 52999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sony WH-1000XM5', 'SKU' => 'SONYWH5-006', 'description' => 'Noise-canceling wireless headphones', 'price' => 15999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple iPad Pro 12.9', 'SKU' => 'IPADPRO-007', 'description' => '12.9-inch Liquid Retina XDR, 256GB', 'price' => 49999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HP LaserJet Pro Printer', 'SKU' => 'HPLJP-008', 'description' => 'Monochrome laser printer', 'price' => 12499.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asus ROG Gaming Laptop', 'SKU' => 'ASUSROG-009', 'description' => 'AMD Ryzen 9, 32GB RAM, RTX 4080', 'price' => 159999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Google Pixel 9', 'SKU' => 'PIXEL9-010', 'description' => 'Google smartphone, 128GB, White', 'price' => 34999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Canon EOS R8 Camera', 'SKU' => 'CANONR8-011', 'description' => 'Full-frame mirrorless camera', 'price' => 89999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nintendo Switch OLED', 'SKU' => 'NSOLED-012', 'description' => 'OLED display, 64GB storage', 'price' => 23999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bose SoundLink Speaker', 'SKU' => 'BOSESL-013', 'description' => 'Portable Bluetooth speaker', 'price' => 7999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seagate External HDD 2TB', 'SKU' => 'SEAGATE2T-014', 'description' => 'USB 3.0 portable hard drive', 'price' => 4499.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung 4K Monitor 32"', 'SKU' => 'SAM4K32-015', 'description' => '32-inch UHD IPS monitor', 'price' => 22999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Razer Mechanical Keyboard', 'SKU' => 'RAZERKB-016', 'description' => 'RGB backlit gaming keyboard', 'price' => 6999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kingston 16GB DDR5 RAM', 'SKU' => 'KNG16DDR5-017', 'description' => '5200MHz laptop memory module', 'price' => 5999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple Watch Ultra 2', 'SKU' => 'AWU2-018', 'description' => '49mm Titanium, GPS + Cellular', 'price' => 31999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DJI Mini 4 Pro Drone', 'SKU' => 'DJIM4P-019', 'description' => '4K HDR camera, 34-min flight time', 'price' => 114999.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy Buds 3 Pro', 'SKU' => 'SGB3P-020', 'description' => 'Noise-cancelling wireless earbuds', 'price' => 9999.00, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
