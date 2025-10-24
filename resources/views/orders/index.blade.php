<?php
$orders;
$name = 'Order overzicht';
$columns = ['referentie nummer', 'klantnaam', 'adres', 'status', 'aantal producten', 'totaal'];
$route = 'orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
