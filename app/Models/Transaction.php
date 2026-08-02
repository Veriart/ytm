<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'total_price',
        'status',
        'shipping_address',
        'shipping_cost',
        'service_fee',
        'discount',
        'notes',
        'delivery_option',
        'tracking_number',
        'midtrans_snap_token',
        'midtrans_payment_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
