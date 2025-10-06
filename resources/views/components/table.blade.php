@props(['name', 'columns', 'objects', 'route'])

<div class="flex flex-col w-full space-y-6">
    <!-- Header met Create knop -->
    {{-- @if (\Illuminate\Support\Facades\URL::current()->contains('invoices'))
        @dd()
    @endif --}}
    <div class="flex justify-between items-center pt-5 px-5">
        <h3 class="text-xl font-bold text-gray-800">{{ $name }}</h3>

        @if (!Route::is('invoices.index'))
            <a href="{{ route($route . '.create') }}"
               class="hover:cursor-pointer px-4 py-2 bg-[#ff9900] hover:bg-yellow-500 text-black font-semibold rounded-lg shadow-sm transition">
                + Nieuw
            </a>
        @endif
    </div>


    <!-- Voorbeeld tabel -->
    <div class="w-full p-6 bg-white shadow rounded-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200">
                <thead class="text-gray-700 bg-gray-100">
                    <tr>
                        @foreach ($columns as $column)
                            <th class="px-4 py-2 border">{{ $column }}</th>
                        @endforeach
                        <th class="px-4 py-2 border">Bekijk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($objects as $object)
                        <tr>
                            @php
                                $object = collect($object);
                                $id = $object->get('id');
                                $object = $object->except('id');
                                $created_at = \Carbon\Carbon::parse($object->get('created_at'))->format('d-m-Y');
                                $updated_at = \Carbon\Carbon::parse($object->get('updated_at'))->format('d-m-Y');
                                $object = $object->toArray();
                                $object['created_at'] = $created_at;
                                $object['updated_at'] = $updated_at;
                            @endphp
                            @foreach ($object as $thing)
                                <td class="px-4 py-2 border">{{ $thing }}</td>
                            @endforeach
                            <td class="px-4 py-2 border">
                                <a href="{{ route($route . '.show', $id) }}"
                                    class="text-green-400 hover:underline hover:cursor-pointer">bekijk</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-3">
                {{ $objects->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
