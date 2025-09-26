<x-layout>
    @php
        if ($address->addressable_type == App\Models\Customer::class) {
            $cancelUrl = route('customers.show', $address->addressable_id);
        }
        if ($address->addressable_type == App\Models\Supplier::class) {
            $cancelUrl = route('supplier.show', $address->addressable_id);
        }
    @endphp

    <div
        class="fixed inset-0 flex items-center justify-center z-50 
               bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div
            class="relative rounded-xl shadow-xl max-w-4xl w-full mx-4 
                   bg-gradient-to-br from-black via-gray-900 to-gray-800 border border-amber-400">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 pt-6">
                <h2 class="text-base font-semibold text-[#ff9900]">
                    Verander
                    {{ $address->street_name . ' ' . $address->house_number . ', ' . $address->city . ', ' . $address->zip_code }}
                </h2>
            </div>

            <form method="POST" action="{{ route('address.update', $address) }}">
                @csrf
                @method('PATCH')

                <div class="px-6 py-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="house_number" class="block text-sm font-medium text-gray-300">
                            Huisnummer
                        </label>
                        <input name="house_number" value="{{ old('house_number', $address->house_number) }}"
                            type="text" id="house_number"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white 
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>

                    <div>
                        <label for="street_name" class="block text-sm font-medium text-gray-300">
                            Straatnaam
                        </label>
                        <input name="street_name" value="{{ old('street_name', $address->street_name) }}" type="text"
                            id="street_name"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white 
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>

                    <div>
                        <label for="zip_code" class="block text-sm font-medium text-gray-300">
                            Postcode
                        </label>
                        <input name="zip_code" value="{{ old('zip_code', $address->zip_code) }}" type="text"
                            id="zip_code"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white 
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-300">
                            Stad/dorp
                        </label>
                        <input name="city" value="{{ old('city', $address->city) }}" type="text" id="city"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white 
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-3 px-6 pb-6 items-center">
                    <button type="submit"
                        class="hover:cursor-pointer px-3 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Opslaan
                    </button>

                    <a href="{{ $cancelUrl }}"
                        class="hover:cursor-pointer px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-sm flex items-center justify-center">
                        Annuleren
                    </a>
                </div>
            </form>

            <!-- Delete modal -->
            <div class="flex justify-end px-6 pb-6 items-center">
                <div class="relative">
                    <input type="checkbox" id="delete-modal-toggle" class="hidden peer" />
                    <label for="delete-modal-toggle"
                        class="hover:cursor-pointer px-3 py-2 bg-red-700 hover:bg-red-600 text-white font-semibold rounded-lg shadow-sm">
                        Verwijderen
                    </label>

                    <div class="fixed inset-0 bg-black/50 hidden peer-checked:flex items-center justify-center z-50">
                        <div class="bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6 text-center space-y-4">
                            <h3 class="text-lg font-bold text-[#ff9900]">Weet je het zeker?</h3>
                            <p class="text-gray-300">Dit kan niet ongedaan worden gemaakt.</p>
                            <div class="flex justify-center gap-3 mt-4">
                                <form method="POST" action="{{ route('address.destroy', $address) }}">
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
    </div>
</x-layout>
