<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Kategori::truncate();
        Schema::enableForeignKeyConstraints();

        Kategori::create([
            'nama_kategori' => 'Kategori 1',
            'deskripsi' => 'Deskripsi Untuk Kategori 1',
            'image' => 'kategori1.img',
        ]);

        Kategori::create([
            'nama_kategori' => 'Kategori 2',
            'deskripsi' => 'Deskripsi Untuk Kategori 2',
            'image' => 'kategori2.img',
        ]);

        Kategori::create([
            'nama_kategori' => 'Kategori 3',
            'deskripsi' => 'Deskripsi Untuk Kategori 3',
            'image' => 'kategori3.img',
        ]);

        Kategori::create([
            'nama_kategori' => 'Kategori 4',
            'deskripsi' => 'Deskripsi Untuk Kategori 4',
            'image' => 'kategori4.img',
        ]);

        Kategori::create([
            'nama_kategori' => 'Kategori 5',
            'deskripsi' => 'Deskripsi Untuk Kategori 5',
            'image' => 'kategori5.img',
        ]);
    }
}
