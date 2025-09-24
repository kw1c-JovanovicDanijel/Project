
<!--Topbar-->
<header class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold tracking-wide text-orange-500">🛒 Amazon Dashboard</h1>
        <div class="flex space-x-4 items-center">
            <span class="text-gray-300">Welkom, Admin</span>
            <button class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg text-white font-semibold">Uitloggen</button>
        </div>
    </div>
</header>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-1/5 bg-gray-800 text-gray-200 p-4 space-y-4">
        <nav class="space-y-3">
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">🏠 Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">👥 Klanten</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">📦 Producten</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">📊 Voorraad</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">📝 Orders</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">🛍️ Bestellingen</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">💰 Facturen</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-orange-500 hover:text-white transition">🚚 Leveranciers</a>
        </nav>
    </aside>

    {{ $slot }}

</div>
