

<x-layout>

    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Factuur Overzicht
            </h1>

            <div class="bg-gray-800 border border-gray-700 shadow-xl rounded-2xl p-8 max-w-lg w-full text-left">

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

                @php $totalPrice = 0; @endphp
                <ul class="space-y-2">
                    @foreach ($order->products as $product)
                        @php
                            $linePrice = $product->pivot->price * $product->pivot->quantity;
                            $totalPrice += $linePrice;
                        @endphp
                        <li class="bg-gray-700 rounded-lg px-4 py-2 flex justify-between items-center">
                            <a href="{{ route('products.show', $product) }}"
                               class="text-gray-300 hover:text-[#ff9900] transition">
                                {{ $product->name }}
                            </a>
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

                <!-- Acties -->
                <div class="mt-6 flex justify-center gap-3 items-center">
                    <a href="{{ route('invoices.index') }}"
                       class="hover:cursor-pointer px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-sm">
                        Terug naar facturen
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
