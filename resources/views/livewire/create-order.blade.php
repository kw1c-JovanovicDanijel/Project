<div class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-gray-800">
    <div
        class="relative w-full max-w-lg mx-4 border shadow-xl rounded-xl bg-gradient-to-br from-black via-gray-900 to-gray-800 border-amber-400">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 pt-6">
            <h2 class="text-base font-semibold text-[#ff9900]">
                Nieuwe order aanmaken
            </h2>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="save">
            <div class="px-6 py-6">
                <!-- Klant select -->
                <div class="mb-4">
                    <label for="customer_id" class="block mb-2 text-sm font-medium text-gray-300">
                        Klant
                    </label>
                    <select wire:model.live="customer_id" id="customer_id" required
                        class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-2">
                        <option value="">Kies een klant...</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }} ({{ $customer->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Adres select -->
                <div>
                    <label for="address_id" class="block mb-2 text-sm font-medium text-gray-300">
                        Adres
                    </label>
                    <select wire:model="address_id" id="address_id"
                        class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-2"
                        @if (!$addresses) disabled @endif>
                        <option value="">Selecteer een adres...</option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->street_name . ' ' . $address->house_number . ', ' . $address->city . ', ' . $address->zip_code }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 px-6 pb-6">
                <button type="submit"
                    class="hover:cursor-pointer px-3 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                    Opslaan
                </button>

                <a href="{{ route('orders.index') }}"
                    class="flex items-center justify-center px-3 py-2 font-semibold text-white bg-gray-700 rounded-lg shadow-sm hover:cursor-pointer hover:bg-gray-600">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
</div>
