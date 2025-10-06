<?php

namespace App\Http\Controllers;

use App\Models\CompanyOrder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalOrders = Order::query()->bezig()->count();
        $totalCompanyOrders = Order::query()->verzonden()->count();

        $total = Order::query()
            ->verzonden()
            ->with('products')
            ->get()
            ->flatMap->products
            ->sum(fn($product) => $product->pivot->price * $product->pivot->quantity);

        // Stel doelen
        $customerGoal = 2000; // doel voor nieuwe klanten deze maand
        $productGoal = 3000; // totaal doel producten
        $supplierGoal = 4000;  // totaal doel leveranciers

        // Dynamische berekeningen voor de progress bars
        $newCustomersThisMonth = Customer::whereMonth('created_at', now()->month)->count();
        $customerGrowthPercent = $customerGoal > 0
            ? min(round(($totalCustomers / $customerGoal) * 100), 100) // max 100%
            : 0;

        $productPercent = $productGoal > 0
            ? min(round(($totalProducts / $productGoal) * 100), 100)
            : 0;

        $supplierPercent = $supplierGoal > 0
            ? min(round(($totalSuppliers / $supplierGoal) * 100), 100)
            : 0;

        return view('dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'totalSuppliers' => $totalSuppliers,
            'totalMoney' => $total,
            'totalOrders' => $totalOrders,
            'totalCompanyOrders' => $totalCompanyOrders,
            'customerGoal' => $customerGoal,
            'customerGrowthPercent' => $customerGrowthPercent,
            'productPercent' => $productPercent,
            'supplierPercent' => $supplierPercent,
        ]);
    }
}
