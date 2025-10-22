<?php
$orders;
$name = 'Bestellingen (bedrijf) overzicht';
$columns = ['referentie nummer', 'orderdatum', 'status', 'gemaakt op', 'geupdate op', 'aantal producten'];
$route = 'company-orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
