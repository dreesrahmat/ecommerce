<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        SubKategori::truncate();
        Schema::enableForeignKeyConstraints();

        SubKategori::create([
            'kategori_id' => 1,
            'nama_subKategori' => 'SubKategori 1',
            'deskripsi' => 'Deskripsi Untuk SubKategori 1',
            'image' => 'SubKategori1.img',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'nama_subKategori' => 'SubKategori 2',
            'deskripsi' => 'Deskripsi Untuk SubKategori 2',
            'image' => 'SubKategori2.img',
        ]);

        SubKategori::create([
            'kategori_id' => 1,
            'nama_subKategori' => 'SubKategori 3',
            'deskripsi' => 'Deskripsi Untuk SubKategori 3',
            'image' => 'SubKategori3.img',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'nama_subKategori' => 'SubKategori 4',
            'deskripsi' => 'Deskripsi Untuk SubKategori 4',
            'image' => 'SubKategori4.img',
        ]);

        SubKategori::create([
            'kategori_id' => 2,
            'nama_subKategori' => 'SubKategori 5',
            'deskripsi' => 'Deskripsi Untuk SubKategori 5',
            'image' => 'SubKategori5.img',
        ]);
    }
}
