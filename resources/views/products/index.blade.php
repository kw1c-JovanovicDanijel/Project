@php
    $route = 'products';
    $columns = ['Naam', 'Beschriving', 'Inkoop prijs', 'Verkoop prijs' , 'Leverancier' ,'Aangemaakt op' , 'Laatst geupdate'];
    $name = 'Producten';

@endphp
<x-layout>
    <x-nav>
        <x-table :name="$name" :objects="$products" :columns="$columns" :route="$route"/>
    </x-nav>
</x-layout>
