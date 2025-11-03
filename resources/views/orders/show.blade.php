@use(\App\Enums\OrderStatus)
@use(\App\Enums\UserRoles)

<x-layout>
    <div class="flex flex-col min-h-screen font-sans bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div class="flex flex-col items-center justify-center flex-1 px-4 text-center">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Order Overzicht
            </h1>

            <div class="w-full max-w-lg p-8 text-left bg-gray-800 border border-gray-700 shadow-xl rounded-2xl">
                <p class="text-gray-700 mb-1">
                    <span class="font-semibold">Aangemaakt op:</span>
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                </p>
                <p class="text-gray-700 mb-4">
                    <span class="font-semibold">Geüpdate op:</span>
                    {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y') }}
                </p>
                <!-- Status -->
                <h2 class="mb-4 text-2xl font-bold text-white">
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
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Naam:</span> {{ $customer->name }}
                </p>
                <p class="mb-2 text-gray-300">
                    <span class="font-semibold text-gray-400">Email:</span> {{ $customer->email }}
                </p>
                <p class="mb-2 text-gray-300">
                    @php
                        $address = $order->address;
                    @endphp
                    <span class="font-semibold text-gray-400">Adres:</span>
                    {{ $address->street_name . ' ' . $address->house_number . ', ' . $address->city . ', ' . $address->zip_code }}
                </p>

                <!-- Adres bewerken -->
                <div class="mt-4">
                    <!-- Toggle Modal -->
                    <div class="relative flex justify-start">
                        <input type="checkbox" id="edit-address-modal-toggle" class="hidden peer"/>
                        <label for="edit-address-modal-toggle"
                               class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg shadow-sm hover:cursor-pointer hover:bg-blue-500">
                            Bewerk adres
                        </label>

                        <!-- Modal -->
                        <div
                            class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 peer-checked:flex">
                            <div class="w-full max-w-md p-6 space-y-4 text-center bg-gray-800 shadow-xl rounded-xl">
                                <h3 class="text-lg font-bold text-[#ff9900]">Adres bewerken</h3>
                                <p class="text-gray-300 mb-4">Selecteer een ander adres voor deze order.</p>

                                <form method="POST" action="{{ route('orders.updateAddress', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}"/>

                                    <select name="address_id"
                                            class="w-full px-4 py-2 text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff9900]">
                                        @foreach ($customer->addresses as $custAddress)
                                            <option value="{{ $custAddress->id }}"
                                                {{ $order->address_id == $custAddress->id ? 'selected' : '' }}>
                                                {{ $custAddress->street_name . ' ' . $custAddress->house_number . ', ' . $custAddress->city }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="flex justify-center gap-3 mt-4">
                                        <button type="submit"
                                                class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:cursor-pointer hover:bg-blue-500">
                                            Opslaan
                                        </button>
                                        <label for="edit-address-modal-toggle"
                                               class="px-4 py-2 font-semibold text-white bg-gray-700 rounded-lg cursor-pointer hover:cursor-pointer hover:bg-gray-600">
                                            Annuleren
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Producten -->
                <h2 class="text-2xl font-bold text-[#ff9900] mt-10 mb-4">
                    Producten
                </h2>

                @if ($order->products->isNotEmpty())
                    @php $totalPrice = 0; @endphp
                    <div class="overflow-x-auto">
                        <table class="w-full overflow-hidden text-sm text-gray-300 border border-gray-700 rounded-lg">
                            <thead class="text-gray-200 bg-gray-700">
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
                                <tr class="transition border-b border-gray-700 hover:bg-gray-700/50">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="text-gray-300 hover:text-[#ff9900] transition font-medium">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-center">{{ $product->pivot->quantity }}</td>
                                    <td class="px-4 py-2 text-right">
                                        €{{ number_format($product->pivot->price, 2, ',', '.') }}</td>
                                    <td class="px-4 py-2 font-semibold text-right text-amber-400">
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
                        <div class="relative flex justify-center mt-6">
                            <input type="checkbox" id="complete-modal-toggle" class="hidden peer"/>
                            <label for="complete-modal-toggle"
                                   class="px-4 py-2 font-semibold text-white bg-green-600 rounded-lg shadow-sm hover:cursor-pointer hover:bg-green-500">
                                Afronden
                            </label>

                            <!-- Modal -->
                            <div
                                class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 peer-checked:flex">
                                <div class="w-full max-w-md p-6 space-y-4 text-center bg-gray-800 shadow-xl rounded-xl">
                                    <h3 class="text-lg font-bold text-[#ff9900]">Order afronden?</h3>
                                    <p class="text-gray-300">Weet je zeker dat je deze order wilt afronden? Dit kan niet
                                        ongedaan worden gemaakt.</p>
                                    <div class="flex justify-center gap-3 mt-4">
                                        <form method="POST" action="{{ route('orders.complete', $order) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="px-4 py-2 font-semibold text-white bg-green-600 rounded-lg hover:cursor-pointer hover:bg-green-500">
                                                Ja, afronden
                                            </button>
                                        </form>
                                        <label for="complete-modal-toggle"
                                               class="px-4 py-2 font-semibold text-white bg-gray-700 rounded-lg cursor-pointer hover:cursor-pointer hover:bg-gray-600">
                                            Annuleren
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="italic text-gray-400">Geen producten</p>
                @endif

                <!-- Acties -->
                <div class="flex items-center justify-center gap-3 mt-6">
                    <a href="{{ route('orders.edit', $order) }}"
                       class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Bewerk producten
                    </a>
                    @if(in_array(auth()->user()->role, [UserRoles::BACKOFFICE_MANAGER->name, UserRoles::ADMIN->name]))
                        <div class="relative flex items-center">
                            <input type="checkbox" id="delete-modal-toggle" class="hidden peer"/>
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
                                        <form method="POST" action="{{ route('orders.destroy', $order) }}">
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
                    @endif
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
