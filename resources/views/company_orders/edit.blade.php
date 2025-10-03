<x-layout>
    <div
        class="fixed inset-0 flex items-center justify-center z-50 
                bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div
            class="relative rounded-xl shadow-xl max-w-4xl w-full mx-4 
                    bg-gradient-to-br from-black via-gray-900 to-gray-800 border border-amber-400">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 pt-6">
                <h2 class="text-base font-semibold text-[#ff9900]">
                    Order #{{ $companyOrder->id }} bewerken
                </h2>
            </div>

            <!-- Producten toevoegen -->
            <form method="POST" action="{{ route('orders.update', $companyOrder) }}" class="px-6 py-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-300 mb-2">
                        Nieuw product toevoegen
                    </label>
                    <select name="product_id" id="product_id" required
                        class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                               shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5">
                        <option value="">-- Kies een product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} (€{{ number_format($product->sell_price, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-300 mb-2">
                        Aantal
                    </label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" required
                        class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                               shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="hover:cursor-pointer px-3 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Toevoegen
                    </button>
                </div>
            </form>

            <!-- Producten in de order -->
            <div class="px-6 py-6">
                <h3 class="text-lg font-bold text-[#ff9900] mb-4">Huidige producten</h3>
                @if ($companyOrder->products->isNotEmpty())
                    <ul class="space-y-2">
                        @php
                            $totalPrice = 0;
                        @endphp

                        @foreach ($companyOrder->products as $product)
                            @php
                                $linePrice = $product->pivot->price * $product->pivot->quantity;
                                $totalPrice += $linePrice;
                            @endphp
                            <li class="flex justify-between items-center bg-gray-800 px-4 py-2 rounded-lg">
                                <span class="text-gray-300">
                                    {{ $product->name }}
                                    (x{{ $product->pivot->quantity }})
                                    -
                                    €{{ number_format($product->pivot->price, 2, ',', '.') }} per stuk
                                    <span class="text-amber-400 font-semibold">
                                        = €{{ number_format($linePrice, 2, ',', '.') }}
                                    </span>
                                </span>

                                <form method="POST" action="{{ route('orders.update', $companyOrder) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="remove_product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="hover:cursor-pointer px-3 py-1 bg-red-700 hover:bg-red-600 text-white rounded-lg text-sm">
                                        Verwijderen
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Totaalprijs -->
                    <div class="mt-4 text-right">
                        <span class="text-lg font-bold text-[#ff9900]">
                            Totale prijs: €{{ number_format($totalPrice, 2, ',', '.') }}
                        </span>
                    </div>
                @else
                    <p class="text-gray-400 italic">Geen producten toegevoegd</p>
                @endif
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 px-6 pb-6">
                <a href="{{ route('company-orders.show', ['company_order' => $companyOrder]) }}"
                    class="hover:cursor-pointer px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-sm flex items-center justify-center">
                    Terug
                </a>
            </div>
        </div>
    </div>
</x-layout>
