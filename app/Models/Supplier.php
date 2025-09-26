<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
