<x-layout>
    <div class="flex flex-col h-screen font-sans bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div class="flex flex-col items-center justify-center flex-1 px-4 text-center">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Product Overzicht
            </h1>

            <div class="w-full max-w-md p-8 text-left bg-gray-800 border border-gray-700 shadow-xl rounded-2xl">
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4">
                    {{ $product->name }}
                </h2>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Description</span> {{ $product->description }}
                </p>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Inkoop prijs</span> €{{ $product->buy_price }}
                </p>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Verkoop prijs</span> €{{ $product->sell_price }}
                </p>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Leverancier</span> {{ $product->supplier->name }}
                </p>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Aangemaakt op:</span>
                    {{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}
                </p>
                <p class="text-gray-300">
                    <span class="font-semibold text-gray-400">Geüpdatet op:</span>
                    {{ \Carbon\Carbon::parse($product->updated_at)->format('d-m-Y') }}
                </p>

                <div class="flex items-center justify-center gap-3 mt-6">
                    <a href="{{ route('products.edit', $product) }}"
                        class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Bewerken
                    </a>

                    <div class="relative flex items-center">
                        <input type="checkbox" id="delete-modal-toggle" class="hidden peer" />
                        <label for="delete-modal-toggle"
                            class="px-4 py-2 font-semibold text-white bg-red-700 rounded-lg shadow-sm hover:cursor-pointer hover:bg-red-600">
                            Verwijderen
                        </label>

                        <div
                            class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 peer-checked:flex">
                            <div class="w-full max-w-md p-6 space-y-4 text-center bg-gray-800 shadow-xl rounded-xl">
                                <h3 class="text-lg font-bold text-[#ff9900]">Weet je het zeker?</h3>
                                <p class="text-gray-300">Dit kan niet ongedaan worden gemaakt.</p>
                                <div class="flex justify-center gap-3 mt-4">
                                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 font-semibold text-white bg-red-700 rounded-lg hover:cursor-pointer hover:bg-red-600">
                                            Ja, verwijderen
                                        </button>
                                    </form>
                                    <label for="delete-modal-toggle"
                                        class="px-4 py-2 font-semibold text-white bg-gray-700 rounded-lg cursor-pointer hover:cursor-pointer hover:bg-gray-600">
                                        Annuleren
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('products.index') }}"
                class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
