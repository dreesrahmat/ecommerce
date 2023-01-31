<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'subkategori';

    protected $fillable = [
        'kategori_id',
        'nama_subkategori',
        'deskripsi',
        'image',
    ];

    /**
     * Get the kategori that owns the SubKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Get all of the produk for the SubKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
