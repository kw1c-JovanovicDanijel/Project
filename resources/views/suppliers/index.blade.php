@php
    $route ='suppliers';
    $columns = ['Naam' , 'E-Mail' , 'Telefoon nummer' , 'Gemaakt Op' , 'Geupdate Op'];
    $name = 'Leveranciers'
@endphp
<x-layout>
    <x-nav>

        <x-table :name="$name" :objects="$suppliers" :columns="$columns" :route="$route"  />

    </x-nav>

</x-layout>
