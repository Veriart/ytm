<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'rating',
        'sold_count',
        'dosage_guidelines',
        'indication',
        'pharmacist_note',
        'brand',
        'target_animals',
        'dosage_form',
        'active_ingredients',
        'registration_number',
        'expiry_date',
        'batch_number',
        'needs_prescription',
    ];

    protected $casts = [
        'needs_prescription' => 'boolean',
        'expiry_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
