<?php

namespace App\Observers;

use App\Enums\OrderStatus;
use App\Models\Invoice;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->invoice == null && $order->status == OrderStatus::VERZONDEN->name) {

            $is_paid = fake()->boolean();

            Invoice::create([
                'order_id' => $order->id,
                'is_paid' => $is_paid,
                'paid_at' => $is_paid ? fake()->dateTime : null
            ]);

        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
