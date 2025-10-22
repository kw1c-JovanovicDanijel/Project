<x-layout>
    <x-nav>
        <main class="flex-1 p-6 space-y-10 bg-gray-100">
            <!-- Dashboard header -->
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800">📊 Dashboard</h1>
                <span class="text-sm text-gray-500">Overzicht & Statistieken</span>
            </div>

            <!-- Widgets Grid -->
            <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                <!-- Klanten -->
                <div class="p-6 text-white shadow-lg bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl">
                    <h2 class="text-sm font-medium">👥 Klanten</h2>
                    <p class="mt-2 text-4xl font-bold">{{ $totalCustomers }}</p>
                    <span class="text-xs text-white/70">Totaal geregistreerd</span>
                </div>

                <!-- Orders -->
                <div class="p-6 text-white shadow-lg bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl">
                    <h2 class="text-sm font-medium">📝 Orders</h2>
                    <p class="mt-2 text-4xl font-bold">{{ $totalOrders }}</p>
                    <span class="text-xs text-white/70">Bezig</span>
                </div>

                <!-- Bestellingen -->
                <div class="p-6 text-white shadow-lg bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl">
                    <h2 class="text-sm font-medium">📝 Orders</h2>
                    <p class="mt-2 text-4xl font-bold">{{ $totalCompanyOrders }}</p>
                    <span class="text-xs text-white/70">Verzonden</span>
                </div>

                <!-- Omzet -->
                <div class="p-4 text-white shadow-lg bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl">
                    <h2 class="text-sm font-medium">🤑 Omzet deze maand</h2>
                    <p class="mt-2 text-4xl font-bold leading-none" style="font-size: min(1.75vw, 2rem);">
                        {{ '€' . number_format($totalMoney, 2, ',', '.') }}
                    </p>

                    <span class="text-xs text-white/70">in euro's</span>
                </div>

                <!-- Producten -->
                <div class="p-6 text-white shadow-lg bg-gradient-to-r from-red-500 to-pink-600 rounded-2xl">
                    <h2 class="text-sm font-medium">📦 Producten</h2>
                    <p class="mt-2 text-4xl font-bold">{{ $totalProducts }}</p>
                    <span class="text-xs text-white/70">Op voorraad</span>
                </div>
            </section>

            <!-- Tweede rij -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Hoogtepunten -->
                <div class="p-6 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-800">✨ Hoogtepunten</h2>
                    <ul class="mt-4 space-y-3 text-sm text-gray-700">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            {{ $totalCustomers }} klanten in totaal
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            {{ $totalCompanyOrders }} orders succesvol verzonden
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                            {{ $totalSuppliers }} leveranciers actief
                        </li>
                    </ul>
                </div>

                <!-- Doelen / voortgang -->
                <div class="p-6 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-800">📌 Doelen</h2>
                    <div class="mt-4 space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Klantengroei</p>
                            <div class="w-full h-2 mt-1 bg-gray-200 rounded-full">
                                <div class="h-2 bg-blue-500 rounded-full" style="width: {{ $customerGrowthPercent }}%">
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $customerGrowthPercent }}%</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Producten toegevoegd</p>
                            <div class="w-full h-2 mt-1 bg-gray-200 rounded-full">
                                <div class="h-2 bg-green-500 rounded-full" style="width: {{ $productPercent }}%"></div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $productPercent }}%</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Samenwerkingen leveranciers</p>
                            <div class="w-full h-2 mt-1 bg-gray-200 rounded-full">
                                <div class="h-2 bg-yellow-500 rounded-full" style="width: {{ $supplierPercent }}%">
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $supplierPercent }}%</span>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </x-nav>
</x-layout>
