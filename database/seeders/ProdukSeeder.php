<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Produk::truncate();
        Schema::enableForeignKeyConstraints();

        Produk::create([
            'kategori_id' => 1,
            'subkategori_id' => 1,
            'nama_produk' => 'celana',
            'image' => 'celana.img',
            'deskripsi' => 'pakaian bawah',
            'harga' => 25000,
            'diskon' => 0,
            'bahan' => 'kulit',
            'tags' => 'celana anti sobek',
            'sku' => 'R22',
            'ukuran' => '26C',
            'warna' => 'merah',
        ]);
    }
}
