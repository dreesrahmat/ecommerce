<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        OrderDetail::truncate();
        Schema::enableForeignKeyConstraints();

        OrderDetail::create([
            'order_id' => 1,
            'produk_id' => 1,
            'jumlah' => 4,
            'ukuran' => '24C',
            'warna' => 'merah',
            'total' => 3,
        ]);
    }
}
