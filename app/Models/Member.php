<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = ['nama_member', 'provinsi', 'kabupaten', 'kecamatan', 'alamat', 'nomor_handphone', 'email', 'password'];

    /**
     * Get all of the order for the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
