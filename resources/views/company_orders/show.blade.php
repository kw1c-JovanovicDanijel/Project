@use(\App\Enums\OrderStatus)

<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Bestelling Overzicht
            </h1>

            <div class="bg-gray-800 border border-gray-700 shadow-xl rounded-2xl p-8 max-w-lg w-full text-left">
                <!-- Status -->
                <h2
                    class="text-2xl font-bold mb-4 
                    {{ $companyOrder->status === OrderStatus::BEZIG->name ? 'text-green-400' : 'text-red-500' }}">
                    {{ $companyOrder->status }}
                </h2>

                <!-- Datums -->
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4 mt-6">
                    Order datums en tijden
                </h2>
                @if ($companyOrder->status == OrderStatus::VERZONDEN->name)
                    <p class="text-gray-300 mb-2">
                        <span class="font-semibold text-gray-400">Verzonden op:</span>
                        {{ \Carbon\Carbon::parse($companyOrder->order_date)->format('d-m-Y') }}
                    </p>
                @endif
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Aangemaakt op:</span>
                    {{ \Carbon\Carbon::parse($companyOrder->created_at)->format('d-m-Y') }}
                </p>
                <p class="text-gray-300">
                    <span class="font-semibold text-gray-400">Geüpdate op:</span>
                    {{ \Carbon\Carbon::parse($companyOrder->updated_at)->format('d-m-Y') }}
                </p>

                <!-- Producten -->
                <h2 class="text-2xl font-bold text-[#ff9900] mt-10 mb-4">
                    Producten
                </h2>

                @if ($companyOrder->products->isNotEmpty())
                    @php $totalPrice = 0; @endphp
                    <ul class="space-y-2">
                        @foreach ($companyOrder->products as $product)
                            @php
                                $linePrice = $product->pivot->price * $product->pivot->quantity;
                                $totalPrice += $linePrice;
                            @endphp
                            <li class="bg-gray-700 rounded-lg px-4 py-2 flex justify-between items-center">
                                <span class="text-gray-300">
                                    {{ $product->name }}
                                </span>
                                <div class="text-right text-gray-300 text-sm">
                                    <span>x{{ $product->pivot->quantity }}</span><br>
                                    <span>€{{ number_format($product->pivot->price, 2, ',', '.') }} per stuk</span><br>
                                    <span class="text-amber-400 font-semibold">
                                        = €{{ number_format($linePrice, 2, ',', '.') }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Totaalprijs -->
                    <div class="mt-6 text-right">
                        <span class="text-lg font-bold text-[#ff9900]">
                            Totale prijs: €{{ number_format($totalPrice, 2, ',', '.') }}
                        </span>
                    </div>
                @else
                    <p class="text-gray-400 italic">Geen producten</p>
                @endif

                <!-- Acties -->
                <div class="mt-6 flex justify-center gap-3 items-center">
                    <a href="{{ route('company-orders.edit', $companyOrder) }}"
                        class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Bewerk producten
                    </a>

                    <form method="POST" action="{{ route('company-orders.destroy', $companyOrder) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="hover:cursor-pointer px-4 py-2 bg-red-700 hover:bg-red-600 text-white font-semibold rounded-lg shadow-sm"
                            onclick="return confirm('Weet je het zeker? Dit kan niet ongedaan worden gemaakt.')">
                            Verwijderen
                        </button>
                    </form>
                </div>
            </div>

            <!-- Terug knop -->
            <a href="{{ route('company-orders.index') }}"
                class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
