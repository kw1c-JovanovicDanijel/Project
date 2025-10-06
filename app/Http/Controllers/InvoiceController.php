<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['order.customer', 'order.products'])
            ->paginate(10)
            ->through(function ($invoice) {
                // totaal aantal producten
                $totalQuantity = $invoice->order->products->sum(function ($product) {
                    return $product->pivot->quantity;
                });

                // totaal prijs (quantity * price)
                $totalPrice = $invoice->order->products->sum(function ($product) {

                    return $product->pivot->quantity * $product->pivot->price;

                });

                $paid_at = \Carbon\Carbon::parse($invoice->paid_at)->format('d-m-Y');

                return [
                    'id' => $invoice->id,
                    'name' => $invoice->order->customer->name ?? '',
                    'product_count' => $totalQuantity,
                    'total_price' => '€'.$totalPrice,
                    'paid_at' => $paid_at,
                    'created_at' => $invoice->created_at,
                    'updated_at' => $invoice->updated_at,
                ];
            });

        return view('invoices.index', compact('invoices'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
