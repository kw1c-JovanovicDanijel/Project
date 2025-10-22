@use(\App\Enums\OrderStatus)

<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Factuur Overzicht
            </h1>

            <div class="bg-gray-800 border border-gray-700 shadow-xl rounded-2xl p-8 max-w-lg w-full text-left">
                <!-- Status -->
                <h2 class="text-2xl font-bold mb-4 text-white">
                    {{ $order->reference }}
                </h2>
                <h2
                    class="text-2xl font-bold mb-4
                    {{ $order->status === OrderStatus::BEZIG->name ? 'text-green-400' : 'text-red-500' }}">
                    {{ $order->status }}
                </h2>

                <!-- Klantinformatie -->
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4">
                    Klantinformatie
                </h2>
                @php
                    $customer = $order->customer;
                @endphp
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Naam:</span> {{ $customer->name }}
                </p>
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Email:</span> {{ $customer->email }}
                </p>

                <!-- Datums -->
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4 mt-6">
                    Order datums en tijden
                </h2>
                @if ($order->status == OrderStatus::VERZONDEN->name)
                    <p class="text-gray-300 mb-2">
                        <span class="font-semibold text-gray-400">Verzonden op:</span>
                        {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}
                    </p>
                @endif
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Aangemaakt op:</span>
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                </p>
                <p class="text-gray-300">
                    <span class="font-semibold text-gray-400">Geüpdate op:</span>
                    {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y') }}
                </p>

                <!-- Producten -->
                <h2 class="text-2xl font-bold text-[#ff9900] mt-10 mb-4">
                    Producten
                </h2>

                @if ($order->products->isNotEmpty())
                    @php $totalPrice = 0; @endphp

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-300 border border-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-700 text-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Product</th>
                                <th class="px-4 py-2 text-center">Aantal</th>
                                <th class="px-4 py-2 text-right">Prijs per stuk</th>
                                <th class="px-4 py-2 text-right">Totaal</th>
                            </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                            @foreach ($order->products as $product)
                                @php
                                    $linePrice = $product->pivot->price * $product->pivot->quantity;
                                    $totalPrice += $linePrice;
                                @endphp
                                <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="text-gray-300 hover:text-[#ff9900] transition font-medium">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        €{{ number_format($product->pivot->price, 2, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-2 text-right text-amber-400 font-semibold">
                                        €{{ number_format($linePrice, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Totaalprijs -->
                    <div class="mt-6 text-right">
                        <span class="text-lg font-bold text-[#ff9900]">
                            Totale prijs: €{{ number_format($totalPrice, 2, ',', '.') }}
                        </span>
                    </div>

                    @if ($order->status !== \App\Enums\OrderStatus::VERZONDEN->name)
                        <!-- Modal toggle using checkbox -->
                        <div class="relative mt-6 flex justify-center">
                            <input type="checkbox" id="complete-modal-toggle" class="hidden peer" />
                            <label for="complete-modal-toggle"
                                   class="hover:cursor-pointer px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg shadow-sm">
                                Afronden
                            </label>

                            <!-- Modal -->
                            <div
                                class="fixed inset-0 bg-black/50 hidden peer-checked:flex items-center justify-center z-50">
                                <div class="bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6 text-center space-y-4">
                                    <h3 class="text-lg font-bold text-[#ff9900]">Order afronden?</h3>
                                    <p class="text-gray-300">Weet je zeker dat je deze order wilt afronden? Dit kan niet
                                        ongedaan worden gemaakt.</p>
                                    <div class="flex justify-center gap-3 mt-4">
                                        <form method="POST" action="{{ route('orders.complete', $order) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="hover:cursor-pointer px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-lg font-semibold">
                                                Ja, afronden
                                            </button>
                                        </form>
                                        <label for="complete-modal-toggle"
                                               class="hover:cursor-pointer px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold cursor-pointer">
                                            Annuleren
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-gray-400 italic">Geen producten</p>
                @endif

                <!-- Acties -->
                <div class="mt-6 flex justify-center gap-3 items-center">
                    <a href="{{ route('orders.edit', $order) }}"
                       class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Bewerk producten
                    </a>

                    <div class="relative flex items-center">
                        <input type="checkbox" id="delete-modal-toggle" class="hidden peer" />
                        <label for="delete-modal-toggle"
                               class="hover:cursor-pointer px-4 py-2 bg-red-700 hover:bg-red-600 text-white font-semibold rounded-lg shadow-sm">
                            Verwijderen
                        </label>

                        <div
                            class="fixed inset-0 bg-black/50 hidden peer-checked:flex items-center justify-center z-50">
                            <div class="bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6 text-center space-y-4">
                                <h3 class="text-lg font-bold text-[#ff9900]">Weet je het zeker?</h3>
                                <p class="text-gray-300">Dit kan niet ongedaan worden gemaakt.</p>
                                <div class="flex justify-center gap-3 mt-4">
                                    <form method="POST" action="{{ route('orders.destroy', $order) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="hover:cursor-pointer px-4 py-2 bg-red-700 hover:bg-red-600 text-white rounded-lg font-semibold">
                                            Ja, verwijderen
                                        </button>
                                    </form>
                                    <label for="delete-modal-toggle"
                                           class="hover:cursor-pointer px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold cursor-pointer">
                                        Annuleren
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terug knop -->
            <a href="{{ route('orders.index') }}"
               class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
