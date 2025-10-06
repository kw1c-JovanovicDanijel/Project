<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $customers = Customer::paginate(10);

        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
        ]);

        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return to_route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        return view('customers.show', ['customer_id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $customer = Customer::find($id);

        return view('customers.edit', ['id' => $customer->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $customer = Customer::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return to_route('customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (! in_array(auth()->user()->role, [UserRoles::ACCOUNT_MANAGER->name, UserRoles::ADMIN->name])) {
            return redirect()->route('dashboard');
        }

        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
        }

        return to_route('customers.index');
    }
}
