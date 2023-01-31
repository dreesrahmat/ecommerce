<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = ['member_id', 'invoice', 'grand_total', 'status'];

    /**
     * Get the member that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get all of the payment for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
