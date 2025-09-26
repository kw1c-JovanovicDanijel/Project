<?php
// Customers krijg je door de controller heen, deze hoef je hier niet neer te zetten maar zodat we dit weten.
$customers;
$name = 'Klanten overzicht';
$columns = ['naam', 'email', 'gemaakt op', 'geupdate op'];
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$customers" />
    </x-nav>
</x-layout>
