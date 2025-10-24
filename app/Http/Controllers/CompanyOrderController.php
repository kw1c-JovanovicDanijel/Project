<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserRoles;
use App\Models\CompanyOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class CompanyOrderController extends Controller
{
    public function index()
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $orders = CompanyOrder::withSum('products as product_count', 'company_order_product.quantity')
            ->paginate(10);

        $orders->getCollection()->map(function ($order) {
            $order->supplier_id = $order->supplier->name;

            return $order;
        });

        $orders->makeHidden('supplier');
        // dd($orders);

        return view('company_orders.index', ['orders' => $orders]);
    }

    public function create()
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        return view('company_orders.create');
    }

    public function store()
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $order = CompanyOrder::create([
            'order_date' => null,
            'status' => OrderStatus::BEZIG,
            'supplier_id' => request()->input('supplier_id'),
        ]);

        return to_route('company-orders.show', $order);
    }

    public function show(CompanyOrder $companyOrder)
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        return view('company_orders.show', ['companyOrder' => $companyOrder]);
    }

    public function edit(CompanyOrder $companyOrder)
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $products = Product::where('supplier_id', $companyOrder->supplier_id)->get();

        return view('company_orders.edit', [
            'companyOrder' => $companyOrder->load('products'),
            'products' => $products,
        ]);
    }

    public function update(Request $request, CompanyOrder $companyOrder)
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        // Verwijderen van een product
        if ($request->has('remove_product_id')) {
            $companyOrder->products()->detach($request->remove_product_id);
        }
        // Toevoegen of updaten van een product
        elseif ($request->has('product_id') && $request->has('quantity')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::find($request->product_id);

            if ($companyOrder->products->contains($product->id)) {
                $companyOrder->products()->updateExistingPivot($product->id, [
                    'quantity' => $request->quantity,
                    'price' => $product->buy_price,
                    'updated_at' => now(),
                ]);
            } else {
                $companyOrder->products()->attach($product->id, [
                    'quantity' => $request->quantity,
                    'price' => $product->buy_price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Updaten van order info
        $companyOrder->update($request->only('order_date', 'status'));

        return redirect()->route('company-orders.edit', $companyOrder);
    }

    public function destroy(CompanyOrder $companyOrder)
    {
        if (! in_array(auth()->user()->role, [UserRoles::LOGISTIEK_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $companyOrder->delete();

        return to_route('company-orders.index');
    }
}
