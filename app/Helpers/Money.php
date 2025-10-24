<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Money
{
    public static function format(string|int|float $input)
    {
        return Str::of(
            str($input)
                ->explode('.')
                ->last()
        )->length() == 2 ? '€'.$input : '€'.$input.'0';
    }
}
