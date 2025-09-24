<?php
use App\Models\Customer;
// $customers = Customer::get()->makehidden('id');
$columns = ['naam', 'email', 'gemaakt op', 'geupdate op'];
$name = 'Klanten overzicht';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$customers" />


    </x-nav>
</x-layout>
