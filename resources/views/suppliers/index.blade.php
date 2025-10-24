@php
    $route = 'suppliers';
    $columns = ['Naam', 'Email', 'Telefoon nummer'];
    $name = 'Leveranciers';
@endphp
<x-layout>
    <x-nav>

        <x-table :name="$name" :objects="$suppliers" :columns="$columns" :route="$route" />

    </x-nav>

</x-layout>
