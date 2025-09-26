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
            </div>

            <a href="{{ route('customer.overview') }}"
                class="mt-8 inline-block px-6 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-layout>
