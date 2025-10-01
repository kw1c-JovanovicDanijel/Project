<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::withSum('products as product_count', 'order_product.quantity')
            ->whereStatus(\App\Enums\OrderStatus::BEZIG)
            ->paginate(10);

        $orders->getCollection()->transform(function ($order) {
            $order->customer_id = Customer::find($order->customer_id)->name;
            $order->makeHidden('order_date');

            return $order;
        });

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => ['required'],
        ]);

        $order = Order::create([
            'customer_id' => $request->input('customer_id'),
            'status' => OrderStatus::BEZIG,
            'order_date' => null,
        ]);

        return to_route('orders.show', $order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order->status === OrderStatus::VERZONDEN->name) {
            return to_route('orders.index');
        }

        return view('orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();

        return view('orders.edit', [
            'order' => $order->load('products'), // laad producten met pivot
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // check of het gaat om toevoegen of verwijderen
        if ($request->has('remove_product_id')) {
            $order->products()->detach($request->remove_product_id);
        } elseif ($request->has('product_id') && $request->has('quantity')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::find($request->product_id);

            // als product al bestaat in de order → update quantity
            if ($order->products->contains($product->id)) {
                $order->products()->updateExistingPivot($product->id, [
                    'quantity' => $request->quantity,
                    'price' => $product->sell_price,
                    'updated_at' => now(),
                ]);
            } else {
                $order->products()->attach($product->id, [
                    'quantity' => $request->quantity,
                    'price' => $product->sell_price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('orders.edit', $order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return to_route('orders.index');
    }
}
