@use(App\Models\Supplier)

@php
    $suppliers = Supplier::all()->sortBy(fn($supplier) => $supplier->name);
@endphp

<x-layout>
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div
            class="relative w-full max-w-lg mx-4 border shadow-xl rounded-xl bg-gradient-to-br from-black via-gray-900 to-gray-800 border-amber-400">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 pt-6">
                <h2 class="text-base font-semibold text-[#ff9900]">
                    Nieuwe bestelling aanmaken
                </h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('company-orders.store') }}">
                @csrf

                <div class="px-6 py-6">
                    <div>
                        <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-300">
                            Leverancier
                        </label>
                        <select name="supplier_id" id="supplier_id" required
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                                   shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-2">
                            <option value="" disabled selected>Kies een leverancier...</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }} ({{ $supplier->email }})
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
</x-layout>
