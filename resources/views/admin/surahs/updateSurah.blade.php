<x-teacher-layout>
    <x-slot name="header">

    </x-slot>

    <div class="overflow-y-auto overflow-x-auto">
        <div class="p-5 sm:ml-64">

            <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Surah Info') }}
            </h2>
            <div class="p-4 sm:ml-64">

            </div>



            <div class="w-full pr-1 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 flex-row items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    @foreach ($surahdata as $data)
                        <form class="max-w-md mx-auto" action="{{ route('admin.surahs.update', $data->id) }}"
                            method="post">
                            @method('PUT')
                            @csrf

                            <div class="mb-5">
                                <label for="SurahName"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surah
                                    Name:</label>
                                <input type="text"name="SurahName" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                    required value="{{ $data->SurahName }}">
                            </div>

                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="SurahMinJuz"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum Juz
                                        of Surah:</label>
                                    <input type="number" name="SurahMinJuz"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required value="{{ $data->SurahMinJuz }}" />
                                </div>

                                <div>
                                    <label for="SurahMaxJuz"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maximum Juz
                                        of Surah:</label>
                                    <input type="number" name="SurahMaxJuz"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required value= "{{ $data->SurahMaxJuz }}" />
                                </div>

                                <div>
                                    <label for="SurahMinPage"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum
                                        Number of Pages:</label>
                                    <input type="number" name="SurahMinPage"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required value= "{{ $data->SurahMinPage }}" />
                                </div>

                                <div>
                                    <label for="SurahMaxPage"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maximum
                                        Number of Pages:</label>
                                    <input type="number" name="SurahMaxPage"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required value= "{{ $data->SurahMaxPage }}" />
                                </div>
                            </div>

                            <div>
                                <label for="SurahMaxAyat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maximum Number
                                    of Ayat:</label>
                                <input type="number" name="SurahMaxAyat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required value={{ $data->SurahMaxAyat }} />
                            </div>
                            <div>
                                <label for="sequences"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surah
                                    Sequences:</label>
                                <input min="0" max="114" type="number" name="sequences"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required value={{ $data->sequences }} />
                            </div>
                    @endforeach

                    <button type="submit"
                        class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>



                    </form>
                </div>
            </div>

        </div>








    </div>

</x-teacher-layout>
