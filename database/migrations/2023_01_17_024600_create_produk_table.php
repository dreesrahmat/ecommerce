<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_id');
            $table->integer('subkategori_id');
            $table->string('nama_produk');
            $table->string('image');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('diskon');
            $table->string('bahan');
            $table->string('tags');
            $table->string('sku');
            $table->string('ukuran');
            $table->string('warna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
