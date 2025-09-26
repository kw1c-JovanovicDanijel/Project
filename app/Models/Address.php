<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    public function customer(): MorphTo
    {
        return $this->morphTo(Customer::class);
    }

    public function supplier(): MorphTo
    {
        return $this->morphTo(Supplier::class);
    }
}
