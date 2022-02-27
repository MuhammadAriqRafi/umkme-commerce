<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\RecordPembeli;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(5)->create();

        Admin::create([
            'name' => 'Rafi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        RecordPembeli::create([
            'name' => 'Ariq',
            'email' => 'ariq@gmail.com',
            'phone' => '08123456789',
            'alamat' => 'Jl. Cempaka'
        ]);

        RecordPembeli::create([
            'name' => 'Rafi',
            'email' => 'Rafi@gmail.com',
            'phone' => '08123456781',
            'alamat' => 'Jl. Cempaka 1'
        ]);

        PaymentMethod::create([
            'metode' => 'COD',
        ]);

        PaymentMethod::create([
            'metode' => 'Gopay',
        ]);

        PaymentMethod::create([
            'metode' => 'Transfer Bank',
        ]);

        OrderStatus::create([
            'status' => 'On Progress'
        ]);

        OrderStatus::create([
            'status' => 'Sent'
        ]);

        OrderStatus::create([
            'status' => 'Canceled'
        ]);

        Order::create([
            'pembeli_id' => 1,
            'payment_method_id' => 1,
            'status_id' => 2
        ]);

        Order::create([
            'pembeli_id' => 2,
            'payment_method_id' => 2,
            'status_id' => 1
        ]);

        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 1
        ]);

        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 3
        ]);

        OrderProduct::create([
            'order_id' => 2,
            'product_id' => 2
        ]);
    }
}
