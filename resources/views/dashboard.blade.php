@php
$columns = ['Naam' , 'E-Mail' , 'Telefoon nummer'];
$name = 'jdididhidhi'
@endphp
<x-layout>
    <x-nav>

   <x-table :name="$name" :objects="$objects" :columns="$columns"  />

    </x-nav>

</x-layout>
