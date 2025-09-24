@props(['colums', 'data'])


<div class="flex items-center justify-center pt-[100px]">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-[1250px]">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

            <tr>

                <th scope="col" class="px-6 py-3">ID</th>

                <th scope="col" class="px-6 py-3">Name</th>

                <th scope="col" class="px-6 py-3">View</th>

                <th scope="col" class="px-6 py-3">Edit</th>

            </tr>

            </thead>

            <tbody>
@php
$users = \App\Models\User::all();
 @endphp
@foreach ($users as $user)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                    <td class="px-6 py-3">{{ $user->id }}</td>

                    <td class="px-6 py-3">{{ $user->name }}</td>


                    <td class="px-6 py-3">

                        <a href="#"

                           class="text-blue-500 hover:underline">View</a>

                    </td>

                    <td class="px-6 py-3">

                        <a href="#"

                           class="text-yellow-500 hover:underline">Edit</a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="pb-[75px]">


        </div>

    </div>

</div>
