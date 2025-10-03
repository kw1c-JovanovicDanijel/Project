<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyOrderProduct extends Pivot
{
    protected $table = 'company_order_product';
}