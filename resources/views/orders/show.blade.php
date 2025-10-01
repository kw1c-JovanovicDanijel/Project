@use(\App\Enums\OrderStatus)

<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Order Overzicht
            </h1>

            <div class="bg-gray-800 border border-gray-700 shadow-xl rounded-2xl p-8 max-w-md w-full text-left">
                <h2 class="text-2xl font-bold mb-4 {{ $order->status === \App\Enums\OrderStatus::BEZIG->name ? 'text-green-400' : 'text-red-500' }}" ">
                    {{ $order->status }}
                </h2>
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
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4">
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

                    <h2 class="text-2xl font-bold text-[#ff9900] mt-10 mb-4">
                        Producten:
                    </h2>

                    @if ($order->products->isNotEmpty())
                        @foreach ($order->products as $i => $product)
                            <a href="{{ route('products.show', $product) }}"
                                class="block text-gray-300 mb-2 hover:text-[#ff9900] transition">
                                <span class="font-semibold text-gray-400">Product {{ $i + 1 }}:</span>
                                {{ $product->name }}
                            </a>
                        @endforeach
                        <div class="mt-4 flex justify-center">
                            <a href="#"
                                class="hover:cursor-pointer px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg shadow-sm">
                                Afronden
                            </a>
                        </div>
                    @else
                        <p class="text-gray-400 italic">Geen producten</p>
                    @endif

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

            <a href="{{ route('orders.index') }}"
                class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
