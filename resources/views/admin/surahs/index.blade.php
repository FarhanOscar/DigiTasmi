<x-teacher-layout>
    <x-slot name="header">

    </x-slot>

    <div>
        <div class="p-4 sm:ml-64 mt-6">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                {{ __('Surah Data') }}
            </h2>



            <div class="p-4 sm:ml-64">

            </div>

            @if (session('alert'))
                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Info alert!</span>{{ session('alert') }}
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Success alert!</span> {{ session('success') }}
                    </div>
                </div>
            @endif



            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <form action="{{ route('admin.surahs.create') }}" method="GET">
                    <button type="submit"
                        class="mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add New Data
                    </button>
                </form>


                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                        <tr>
                            <th scope="col" class="p-4">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surah Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surah Juz
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surah Page
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surah Maximum Ayat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Surah Sequences
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                        @forelse ($surahdata as $data)
                            <form action="{{ route('admin.surahs.edit', ['surah' => Crypt::encrypt($data->id)]) }}"
                                class="max-w-sm mx-auto">

                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->SurahName }}

                                    </td>
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->SurahMinJuz }} ~ {{ $data->SurahMaxJuz }}

                                    </td>
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->SurahMinPage }} ~ {{ $data->SurahMaxPage }}

                                    </td>

                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->SurahMaxAyat }}

                                    </td>
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->sequences }}

                                    </td>

                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <div class="px-2">

                                                <button type="submit"
                                                    class="px-4 py-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Edit</button>
                                            </div>
                            </form>


                            <div class="px-2">
                                <form action="{{ route('admin.surahs.destroy', ['surah' => $data->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-3 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Remove</button>
                                </form>
                            </div>
            </div>









            </td>



            </tr>


        @empty
            <tr>

                <td colspan="8"
                    class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    No results found
                </td>
            </tr>
            @endforelse




            </tbody>


            </table>


        </div>


        <div class="gap-y content">
            <div class="flex-1 -8 mt-4">
                {{-- {!! $userdata->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!} --}}
            </div>
        </div>



    </div>
    </div>
</x-teacher-layout>
