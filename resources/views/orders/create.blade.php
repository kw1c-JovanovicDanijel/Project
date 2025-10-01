@use(App\Models\Customer)

@php
    $customers = Customer::all();
@endphp

<x-layout>
    <div
        class="fixed inset-0 flex items-center justify-center z-50 
                bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div
            class="relative rounded-xl shadow-xl max-w-lg w-full mx-4 
                    bg-gradient-to-br from-black via-gray-900 to-gray-800 border border-amber-400">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 pt-6">
                <h2 class="text-base font-semibold text-[#ff9900]">
                    Nieuwe order aanmaken
                </h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <div class="px-6 py-6">
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-300 mb-2">
                            Klant
                        </label>
                        <select name="customer_id" id="customer_id" required
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-2">
                            <option value="" disabled selected>Kies een klant...</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
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
                        class="hover:cursor-pointer px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-sm flex items-center justify-center">
                        Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
