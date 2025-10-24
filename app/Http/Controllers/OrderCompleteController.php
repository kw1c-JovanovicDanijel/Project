<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserRoles;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderCompleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        if (! in_array(auth()->user()->role, [UserRoles::BACKOFFICE_MEDEWERKER->name, UserRoles::BACKOFFICE_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $order->update([
            'status' => OrderStatus::VERZONDEN->name,
            'order_date' => now(),
        ]);

        return redirect()->route('orders.show', $order);
    }
}
