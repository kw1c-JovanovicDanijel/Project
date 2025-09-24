@props(['title', 'data'])

<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
    <h3 class="text-gray-600 text-sm">{{ $title }}</h3>
    <p class="text-2xl font-bold text-orange-500">{{ $data }}</p>
</div>
