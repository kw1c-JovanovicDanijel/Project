<?php

namespace App\Observers;

use App\Enums\OrderStatus;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $number = random_int(1, 999999999);
        $padded = Str::padLeft($number, 9, 0);
        $reference = 'ORD#'.$padded;

        $order->update([
            'reference' => $reference,
        ]);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->invoice == null) {
            if ($order->status == OrderStatus::VERZONDEN->name || $order->status == OrderStatus::VERZONDEN) {

                $is_paid = fake()->boolean();

                Invoice::create([
                    'order_id' => $order->id,
                    'paid_at' => $is_paid ? fake()->dateTimeThisCentury() : null,
                ]);
            }
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
