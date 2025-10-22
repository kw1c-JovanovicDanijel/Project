<?php
$orders;
$name = 'Bestellingen (bedrijf) overzicht';
$columns = ['referentie nummer', 'orderdatum', 'status','aantal producten'];
$route = 'company-orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
