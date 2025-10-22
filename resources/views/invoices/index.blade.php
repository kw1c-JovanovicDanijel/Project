@php
    $name = 'Factuur overzicht';
    $columns = ['Naam' , 'Aantal Producten' , 'Prijs' , 'Betaal Datum'];
    $route = 'invoices';
@endphp

<x-layout>
    <x-nav>
        <x-table :name="$name" :objects="$invoices" :columns="$columns" :route="$route" />
    </x-nav>
</x-layout>

