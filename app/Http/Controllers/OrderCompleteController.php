<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderCompleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        $order->update([
            'status' => OrderStatus::VERZONDEN->name,
            'order_date' => now(),
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order is afgerond!');
    }
}
