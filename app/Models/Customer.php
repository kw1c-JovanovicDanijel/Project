<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    // TODO: Copy this to suppliers when done
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
