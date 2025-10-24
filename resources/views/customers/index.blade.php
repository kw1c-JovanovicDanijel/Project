<?php
// Customers krijg je door de controller heen, deze hoef je hier niet neer te zetten maar zodat we dit weten.
$customers;
$name = 'Klanten overzicht';
$columns = ['Naam', 'Email'];
$route = 'customers';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$customers" :route="$route" />
    </x-nav>
</x-layout>
