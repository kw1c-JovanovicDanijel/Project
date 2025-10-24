<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Observers\CompanyOrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy(CompanyOrderObserver::class)]
class CompanyOrder extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'company_order_product')
            ->withPivot('quantity', 'price', 'created_at', 'updated_at');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // als je $order->bezig() aanroept terwijl het nog sql is,
    // voert het dit op de achtergrond uit, en je kan je query nog verder bouwen
    #[Scope]
    public function bezig(Builder $query)
    {
        return $query->whereStatus(OrderStatus::BEZIG);
    }

    #[Scope]
    public function verzonden(Builder $query)
    {
        return $query->whereStatus(OrderStatus::VERZONDEN);
    }
}
