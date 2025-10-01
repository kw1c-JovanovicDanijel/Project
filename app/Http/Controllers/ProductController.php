<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        $products->getCollection()->map(function ($product) {
            $product->supplier_id = Supplier::find($product->supplier_id)->name;

            // hier zorg je ervoor dat je ... krijgt als het over de 50 karakters is
            $product->description = str($product->description)->limit(50);
            // hier zorg je ervoor dat er een euro teken komt voor de getallen bij de inkoop prijs en verkoop prijs
            // . zorgt ervoor dat de getallen worden geforceerd naar string zodat de euro teken erbij kan en dat je strings bij elkaar kan zetten
            $product->buy_price = '€' . $product->buy_price;
            $product->sell_price = '€' . $product->sell_price;

            return $product;
        });

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        return view('products.create', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'buy_price' => $request->input('buy_price'),
            'supplier_id' => $request->input('supplier_id'),
        ]);

        return to_route('products.show', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'supplier_id' => ['required'],
        ]);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'buy_price' => $request->input('buy_price'),
            'supplier_id' => $request->input('supplier_id'),
        ]);

        return to_route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);
        if ($product) {
            $product->delete();
        }

        return to_route('products.index');
    }
}
