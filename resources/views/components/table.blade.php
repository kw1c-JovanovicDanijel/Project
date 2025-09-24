@props(['name', 'columns', 'objects'])


<div class="flex flex-row items-center w-full space-y-6">

    <!-- Voorbeeld tabel -->
    <div class="w-full p-6 bg-white shadow rounded-xl">
        <h3 class="mb-4 text-xl font-bold text-gray-800">
            {{ $name }}
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200">
                <thead class="text-gray-700 bg-gray-100">
                    <tr>
                        @foreach ($columns as $column)
                            <th class="px-4 py-2 border">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($objects as $object)
                        <tr>
                            @php
                                $object = collect($object);
                                $created_at = \Carbon\Carbon::parse($object->get('created_at'))->format('d-m-Y');
                                $updated_at = \Carbon\Carbon::parse($object->get('updated_at'))->format('d-m-Y');
                                $object = $object->toarray();
                                $object['created_at'] = $created_at;
                                $object['updated_at'] = $updated_at;
                            @endphp
                            @foreach ($object as $thing)
                                <td class="px-4 py-2 border">{{ $thing }}</td>
                            @endforeach
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
