<x-layout>
    <div class="h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 flex flex-col font-sans">
        <div class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-5xl font-extrabold text-[#ff9900] drop-shadow-lg">Welkom bij het OMS</h1>
            <p class="mt-4 text-lg text-gray-300 max-w-xl">
                Beheer al je orders eenvoudig en efficiënt in ons Order Management System.
            </p>
            <a href="{{ route('login.show') }}"
                class="mt-8 px-8 py-3 bg-[#ff9900] text-black text-lg font-bold rounded-md shadow-lg hover:bg-yellow-500 transition">
                Log in
            </a>
        </div>
    </div>
</x-layout>
