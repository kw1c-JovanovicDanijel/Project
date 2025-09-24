<?php
use App\Models\Customer;
$customers = Customer::get()->makehidden('id');
$columns = ['naam', 'email', 'gemaakt op', 'geupdate op'];
?>
<x-layout>
    <x-nav>
        <x-table :columns="$columns" :objects="$customers" />
    </x-nav>
</x-layout>
