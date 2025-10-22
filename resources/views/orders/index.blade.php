<?php
$orders;
$name = 'Order overzicht';
$columns = ['referentie nummer', 'klantnaam', 'status','aantal producten'];
$route = 'orders';
?>
<x-layout>
    <x-nav>
        <x-table :name="$name" :columns="$columns" :objects="$orders" :route="$route" />
    </x-nav>
</x-layout>
