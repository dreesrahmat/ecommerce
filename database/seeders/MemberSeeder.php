<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Member::truncate();
        Schema::enableForeignKeyConstraints();

        Member::create([
            'nama_member' => 'member satu',
            'provinsi' => 'jawa timur',
            'kabupaten' => 'malang',
            'kecamatan' => 'sukun',
            'alamat' => 'jl. dinoyo',
            'nomor_handphone' => '089530519445',
            'email' => 'satu@gmail.com',
            'password' => 'rahasia',
        ]);
    }
}
