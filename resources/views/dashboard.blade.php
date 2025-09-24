<x-layout>
    <x-nav>
        <!-- Main Content -->
        <main class="flex-1 p-8"><h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Overzicht</h2>
            <!-- Statistieken -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"><h3
                        class="text-gray-600 text-sm">
                        Totale Klanten</h3>
                    <p class="text-2xl font-bold text-orange-500">1,250</p></div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"><h3
                        class="text-gray-600 text-sm">
                        Actieve Orders</h3>
                    <p class="text-2xl font-bold text-orange-500">320</p></div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"><h3
                        class="text-gray-600 text-sm">
                        Omzet (Maand)</h3>
                    <p class="text-2xl font-bold text-orange-500">€45.000</p></div>
            </div> <!-- Voorbeeld tabel -->
            <div class="bg-white shadow rounded-xl p-6"><h3 class="text-xl font-bold text-gray-800 mb-4">Laatste
                    Bestellingen</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Order ID</th>
                            <th class="px-4 py-2 border">Klant</th>
                            <th class="px-4 py-2 border">Datum</th>
                            <th class="px-4 py-2 border">Status</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-2 border">#1023</td>
                            <td class="px-4 py-2 border">Jan Jansen</td>
                            <td class="px-4 py-2 border">20-09-2025</td>
                            <td class="px-4 py-2 border"><span class="bg-green-100 text-green-700 px-2 py-1 rounded">Verzonden</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">#1024</td>
                            <td class="px-4 py-2 border">Sara de Vries</td>
                            <td class="px-4 py-2 border">21-09-2025</td>
                            <td class="px-4 py-2 border"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">In behandeling</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">#1025</td>
                            <td class="px-4 py-2 border">Piet Pietersen</td>
                            <td class="px-4 py-2 border">22-09-2025</td>
                            <td class="px-4 py-2 border"><span
                                    class="bg-red-100 text-red-700 px-2 py-1 rounded">Geannuleerd</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </x-nav>
</x-layout>
