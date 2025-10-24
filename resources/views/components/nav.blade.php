@use('App\Enums\UserRoles')

<!-- Topbar -->
<header class="text-white bg-gray-900 shadow-md">
    <div class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl">
        <h1 class="text-2xl font-bold tracking-wide text-orange-500">Amazon Dashboard</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-300">Welkom, {{ auth()?->user()?->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 font-semibold text-white bg-orange-500 rounded-lg cursor-pointer hover:bg-orange-600">
                    Uitloggen
                </button>
            </form>
        </div>
    </div>
</header>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-1/5 p-4 pb-0 space-y-4 text-gray-200 bg-gray-800">
        <nav class="space-y-3">

            <!-- Altijd zichtbaar -->
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">🏠 Dashboard</a>

            @php
                $role = auth()?->user()->role;
            @endphp

                <!-- Alleen voor Account Managers -->
            @if ($role === UserRoles::ACCOUNT_MANAGER->name)
                <a href="{{ route('customers.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">👥 Klanten</a>
            @endif

            <!-- Alleen voor Product Managers -->
            @if ($role === UserRoles::PRODUCT_MANAGER->name)
                <a href="{{ route('products.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">📦 Producten</a>
                <a href="{{ route('suppliers.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">🚚 Leveranciers</a>
            @endif

            <!-- Voor Backoffice medewerker & manager -->
            @if (in_array($role, [
                UserRoles::BACKOFFICE_MEDEWERKER->name,
                UserRoles::BACKOFFICE_MANAGER->name,
            ]))
                <a href="{{ route('orders.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">📝 Orders</a>
                <a href="{{ route('invoices.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">💰 Facturen</a>
            @endif

            <!-- Alleen voor Logistiek Manager -->
            @if ($role === UserRoles::LOGISTIEK_MANAGER->name)
                <a href="{{ route('company-orders.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">🛍️ Bestellingen</a>
            @endif

            <!-- Admin ziet alles één keer -->
            @if ($role === UserRoles::ADMIN->name)
                <a href="{{ route('customers.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">👥 Klanten</a>
                <a href="{{ route('products.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">📦 Producten</a>
                <a href="{{ route('orders.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">📝 Orders</a>
                <a href="{{ route('invoices.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">💰 Facturen</a>
                <a href="{{ route('suppliers.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">🚚 Leveranciers</a>
                <a href="{{ route('company-orders.index') }}"
                   class="block px-4 py-2 transition rounded-lg hover:bg-orange-500 hover:text-white">🛍️ Bestellingen</a>
            @endif
        </nav>
    </aside>

    {{ $slot }}
</div>
