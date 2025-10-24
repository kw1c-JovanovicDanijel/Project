<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class UpdateAdressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'address_id' => 'required',
        ]);

        Order::find($request->order_id)->update([
            'address_id' => $request->address_id,
        ]);

        return back();

    }
}
