<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['nama_kategori', 'deskripsi', 'image'];

    /**
     * Get all of the subkategori for the SubKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkategori(): HasMany
    {
        return $this->hasMany(SubKategori::class);
    }

    /**
     * Get all of the produk for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
