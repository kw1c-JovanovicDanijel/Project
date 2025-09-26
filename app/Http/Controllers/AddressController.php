<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $previousUrl = URL::previous();
        $addressable_id = null;
        $addressable_type = null;

        if (str_contains($previousUrl, '/customers/')) {
            $addressable_type = Customer::class;

            $segments = explode('/', parse_url($previousUrl, PHP_URL_PATH));
            $addressable_id = end($segments);
        } elseif (str_contains($previousUrl, '/suppliers/')) {
            $addressable_type = Supplier::class;

            $segments = explode('/', parse_url($previousUrl, PHP_URL_PATH));
            $addressable_id = end($segments);
        }

        return view('address.create', [
            'addressable_id' => $addressable_id,
            'addressable_type' => $addressable_type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'house_number' => ['required', 'string', 'max:10'],
        'street_name' => ['required', 'string', 'max:255'],
        'zip_code' => ['required', 'string', 'max:20'],
        'city' => ['required', 'string', 'max:100'],
        'addressable_type' => ['required', 'string'],
        'addressable_id' => ['required', 'integer'],
    ]);

    $address = Address::create([
        'house_number' => $request->input('house_number'),
        'street_name' => $request->input('street_name'),
        'zip_code' => $request->input('zip_code'),
        'city' => $request->input('city'),
        'addressable_type' => $request->input('addressable_type'),
        'addressable_id' => $request->input('addressable_id'),
    ]);

    // Redirect naar juiste parent
    if ($address->addressable_type == Customer::class) {
        return to_route('customer.show', $address->addressable_id);
    }

    if ($address->addressable_type == Supplier::class) {
        return to_route('supplier.show', $address->addressable_id);
    }

    return to_route('home');
}


    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('address.edit', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'house_number' => ['required', 'string', 'max:10'],
            'street_name' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
        ]);

        $address->update([
            'house_number' => $request->input('house_number'),
            'street_name' => $request->input('street_name'),
            'zip_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
        ]);

        if ($address->addressable_type == Customer::class) {
            return to_route('customer.show', $address->addressable_id);
        }

        if ($address->addressable_type == Supplier::class) {
            return to_route('supplier.show', $address->addressable_id) ?? to_route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        if ($address->addressable_type == Customer::class) {
            return to_route('customer.show', $address->addressable_id);
        }

        if ($address->addressable_type == Supplier::class) {
            return to_route('supplier.show', $address->addressable_id) ?? to_route('home');
        }
    }
}
