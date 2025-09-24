@props(['columns', 'data'])

<div class="flex flex-col items-center justify-center pt-20 space-y-6 w-full">

    @php
        $users = \App\Models\User::all();
    @endphp

        <!-- Voorbeeld tabel -->
        <div class="bg-white shadow rounded-xl p-6 w-full"><h3 class="text-xl font-bold text-gray-800 mb-4">Laatste
                Bestellingen</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Order ID</th>
                        <th class="px-4 py-2 border">Klant</th>
                        <th class="px-4 py-2 border">Datum</th>
                        <th class="px-4 py-2 border">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)

                        <tr>
                        <td class="px-4 py-2 border">{{$user->id}}</td>
                        <td class="px-4 py-2 border">Jan Jansen</td>
                        <td class="px-4 py-2 border">20-09-2025</td>
                        <td class="px-4 py-2 border"><span class="bg-green-100 text-green-700 px-2 py-1 rounded">Verzonden</span>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

</div>
