@use(App\Models\Customer)

@php
    $customer = Customer::find($customer_id);
@endphp

<x-layout>
    <div class="h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#ff9900] drop-shadow-lg mb-8">
                Klant Overzicht
            </h1>

            <div class="bg-gray-800 border border-gray-700 shadow-xl rounded-2xl p-8 max-w-md w-full text-left">
                <h2 class="text-2xl font-bold text-[#ff9900] mb-4">
                    {{ $customer->name }}
                </h2>
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Email:</span> {{ $customer->email }}
                </p>
                <p class="text-gray-300 mb-2">
                    <span class="font-semibold text-gray-400">Aangemaakt op:</span>
                    {{ \Carbon\Carbon::parse($customer->created_at)->format('d-m-Y') }}
                </p>
                <p class="text-gray-300">
                    <span class="font-semibold text-gray-400">Geüpdatet op:</span>
                    {{ \Carbon\Carbon::parse($customer->updated_at)->format('d-m-Y') }}
                </p>

                <h2 class="text-2xl font-bold text-[#ff9900] mt-10 mb-4">
                    Adressen:
                </h2>

                @if ($customer->addresses->isNotEmpty())
                    @foreach ($customer->addresses as $i => $address)
                        <a href="{{ route('address.edit', $address) }}"
                            class="block text-gray-300 mb-2 hover:text-[#ff9900] transition">
                            <span class="font-semibold text-gray-400">Adres {{ $i + 1 }}:</span>
                            {{ $address->street_name . ' ' . $address->house_number . ', ' . $address->city . ', ' . $address->zip_code }}
                        </a>
                    @endforeach
                @else
                    <p class="text-gray-400 italic">Geen adres beschikbaar</p>
                @endif

                <!-- Knop nieuw adres toevoegen -->
                <div class="mt-4 flex justify-center">
                    <a href="{{ route('address.create', ['addressable_type' => App\Models\Customer::class, 'addressable_id' => $customer->id]) }}"
                        class="hover:cursor-pointer px-4 py-2 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-lg shadow-sm">
                        Nieuw adres toevoegen
                    </a>
                </div>


                <div class="mt-6 flex justify-center gap-3 items-center">
                    <a href="{{ route('customer.edit', $customer) }}"
                        class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Bewerken
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
                                    <form method="POST" action="{{ route('customer.destroy', $customer) }}">
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

            <a href="{{ route('customer.overview') }}"
                class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
