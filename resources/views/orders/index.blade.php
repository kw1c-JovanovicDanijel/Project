<?php
$orders;
$name = 'Order overzicht';
$columns = ['Referentie nummer', 'Klantnaam', 'Adres', 'Status', 'Aantal producten', 'Totaal'];
$route = 'orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
