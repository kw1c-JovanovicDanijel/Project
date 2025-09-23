<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    {{-- Load in tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
@php $colums = ['id' , 'name' , 'view' , 'edit'];
$data = [[1, 'dj' , 'view' , 'edit']];
@endphp
<x-table :colums="$colums" :data="$data" />
    {{ $slot }}
</body>

</html>
