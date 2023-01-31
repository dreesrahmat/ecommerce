<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['kategori_id', 'subkategori_id', 'nama_produk', 'image', 'deskripsi', 'harga', 'diskon', 'bahan', 'tags', 'sku', 'ukuran', 'warna'];

    /**
     * Get the kategori that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Get the subkategori that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subkategori(): BelongsTo
    {
        return $this->belongsTo(SubKategori::class);
    }
}
