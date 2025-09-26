<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    //TODO: when orders exist
//    public function order(): BelongsToMany
//    {
//        return $this->belongsToMany(Order::class);
//    }
}
