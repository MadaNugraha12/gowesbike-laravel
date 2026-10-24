<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price',
        'description',
        'groupset',
        'brakes',
        'wheelset',
        'tires',
        'crankset',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orderDetails(): HasMany
    {
    return $this->hasMany(OrderDetail::class);
    }
}