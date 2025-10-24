<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserRoles;
use App\Models\CompanyOrder;
use Illuminate\Http\Request;

class CompanyOrderCompleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompanyOrder $companyOrder)
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $companyOrder->update([
            'status' => OrderStatus::VERZONDEN->name,
            'order_date' => now(),
        ]);

        return redirect()->route('company-orders.show', $companyOrder);
    }
}
