<x-layout>
    @php $colums = ['id' , 'name' , 'view' , 'edit'];
 $data = [[1, 'dj' , 'view' , 'edit']];
    @endphp
    <x-table :colums="$colums" :data="$data" />
</x-layout>
