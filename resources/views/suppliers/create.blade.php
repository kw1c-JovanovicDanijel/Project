<x-layout>
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div
            class="relative w-full max-w-4xl mx-4 border shadow-xl rounded-xl bg-gradient-to-br from-black via-gray-900 to-gray-800 border-amber-400">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 pt-6">
                <h2 class="text-base font-semibold text-[#ff9900]">
                    Nieuwe leverancier aanmaken
                </h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-6 px-6 py-6 lg:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">
                            Naam
                        </label>
                        <input name="name" value="{{ old('name') }}" type="text" id="name"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                                      shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            Email
                        </label>
                        <input name="email" value="{{ old('email') }}" type="email" id="email"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                                      shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-300">
                            Telefoonnummer
                        </label>
                        <input name="phone_number" value="{{ old('phone_number') }}" type="text" id="phone_number"
                            class="mt-1 block w-full rounded-lg border border-gray-700 bg-gray-800 text-white
                                      shadow-sm focus:ring-2 focus:ring-[#ff9900] sm:text-sm sm:leading-6 px-3 py-1.5" />
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 px-6 pb-6">
                    <button type="submit"
                        class="hover:cursor-pointer px-3 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm">
                        Opslaan
                    </button>

                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center justify-center px-3 py-2 font-semibold text-white bg-gray-700 rounded-lg shadow-sm hover:cursor-pointer hover:bg-gray-600">
                        Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
