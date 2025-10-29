<x-layout>
    <div class="flex flex-col h-screen font-sans bg-gradient-to-br from-black via-gray-900 to-gray-800">
        <div class="flex items-center justify-center flex-1">
            <div class="w-full max-w-md p-8 bg-gray-800 border border-gray-700 shadow-2xl rounded-2xl">
                <h2 class="mb-6 text-3xl font-bold text-center text-[#ff9900]">Inloggen</h2>

                <!-- Formulier -->
                <form method="POST" action="{{ route('login.show')}}">
                    @csrf

                    <!-- Email -->
                    <div>
                        @error('email')
                            <p class="mb-2 text-sm text-center text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                        <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 mt-2 text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-[#ff9900] focus:outline-none"
                            placeholder="jouw@email.com" value="{{ old('email') }}">
                    </div>

                    <!-- Wachtwoord -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-300">Wachtwoord</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 mt-2 text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-[#ff9900] focus:outline-none"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full py-3 mt-6 font-semibold text-black transition bg-[#ff9900] rounded-lg shadow-md hover:bg-yellow-500 cursor-pointer">
                        Log in
                    </button>

                    <a href="{{ route('home') }}"
                        class="block w-full py-3 mt-4 font-semibold text-center text-white transition bg-gray-700 rounded-lg shadow-md hover:bg-gray-600">
                        Terug naar home
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
