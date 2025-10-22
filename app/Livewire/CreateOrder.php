<?php

namespace App\Livewire;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;

class CreateOrder extends Component
{
    public $customers;

    public $customer_id;

    public $address_id;

    public $addresses = [];

    public function mount()
    {
        $this->customers = Customer::all()->sortBy('name');
    }

    public function updatedCustomerId($value)
    {
        // Haal de adressen van de klant op
        $this->addresses = Customer::find($value)?->addresses ?? [];

        // Reset geselecteerde address
        $this->address_id = null;
    }

    public function save()
    {
        $order = Order::create([
            'customer_id' => $this->customer_id,
            'address_id' => $this->address_id,
            'status' => OrderStatus::BEZIG,
        ]);

        return to_route('orders.show', ['order' => $order]);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
