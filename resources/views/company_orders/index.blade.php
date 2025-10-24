<?php
$orders;
$name = 'Bestellingen (bedrijf) overzicht';
$columns = ['Referentie nummer', 'Orderdatum', 'Status', 'Leverancier', 'Aantal producten'];
$route = 'company-orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
