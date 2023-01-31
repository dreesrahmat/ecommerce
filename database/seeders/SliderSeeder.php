<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Slider::truncate();
        Schema::enableForeignKeyConstraints();

        Slider::create([
            'nama_slider' => 'slider 1',
            'deskripsi' => 'Deskripsi Untuk slider 1',
            'image' => 'slider1.img',
        ]);

        Slider::create([
            'nama_slider' => 'slider 2',
            'deskripsi' => 'Deskripsi Untuk slider 2',
            'image' => 'slider2.img',
        ]);

        Slider::create([
            'nama_slider' => 'slider 3',
            'deskripsi' => 'Deskripsi Untuk slider 3',
            'image' => 'slider3.img',
        ]);

        Slider::create([
            'nama_slider' => 'slider 4',
            'deskripsi' => 'Deskripsi Untuk slider 4',
            'image' => 'slider4.img',
        ]);

        Slider::create([
            'nama_slider' => 'slider 5',
            'deskripsi' => 'Deskripsi Untuk slider 5',
            'image' => 'slider5.img',
        ]);
    }
}
