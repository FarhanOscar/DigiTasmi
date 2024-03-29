<x-teacher-layout>
    <x-slot name="header">

    </x-slot>

    <div>
        <div class="p-5 sm:ml-64">

            <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Report') }}
            </h2>




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


            <div class="relative overflow-x-auto">
                <table 
                    class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead
                        class=" border border-l-2 border-t-2  border-gray-400 text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">


                        <tr class="border-r-2 border-gray-400 ">
                            <th colspan="1" scope="col" class="p-4 uppercase ">
                                Teacher Name

                            </th>
                            <th colspan="8" scope="col" class="p-4">
                                {{ $className->user->name }}
                            </th>
                            
                           
                        </tr>
                        <tr class=" border-b-2 border-r-2 border-gray-400 ">
                            <th colspan="1" scope="col" class="p-4 uppercase">
                                Class Name
                            </th>
                            <th colspan="3" scope="col" class="p-4">
                                {{ $className->ClassName }}
                            </th>
                            <th scope="col" class="p-2 uppercase">
                                Month
                            </th>
                            <th>
                             


                                <form id="filterForm" method="GET" action="{{ route('admin.classes.pdf', ['ClassId'=>Crypt::encrypt($className->id)]) }}" >
                                    <select name="select1" id="monthSelect"
                                        class="mb-2 block text-sm border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value='' selected>--Show All --</option>
                                        @foreach ($month as $month)
                                            <option value="{{ $month->month }}"
                                                {{ $monthselect == $month->month ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $month->month, 10)) }}
                                            </option>
                                        @endforeach
                                    </select>
                            </th>
                            <th scope="col" class="p-2 uppercase">
                                Year
                            </th>
                            <th>
                                <select name="select2" id="yearSelect"
                                    class="mb-2 block  text-sm border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <!-- Add options for select2 here -->
                                    @foreach ($year as $year)
                                        <option value="{{ $year->year }}"
                                            {{ $yearselect == $year->year ? 'selected' : '' }}>
                                            {{ $year->year }}
                                        </option><!-- Add options for select1 here -->
                                    @endforeach


                                </select>

                            </th>
                            <th>
                                <button type="submit" name="action" value="filter"
                                    class="mb-2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Filter
                                </button>

                               
                                </form>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>




            <div class="overflow-x-auto w-full mt-6 relative  shadow-md ">
                <div id="app">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            


                            <tr class="border border-b-2  border-gray-400 ">
                                <th scope="col" colspan="1"
                                    class=" bg-gray-300  border border-l-2 border-t-2   border-gray-400 px-6 py-3 p-6">
                                    #</th>
                                    <th scope="col" colspan="1"
                                    class=" bg-gray-300 border border-l-2 border-t-2   border-gray-400   px-6 py-3">
                                    Student Name</th>
                                    <th scope="col" colspan="1"
                                    class=" bg-gray-300 border border-l-2 border-t-2   border-gray-400   px-6 py-3">
                                    Surah</th>
                                    <th scope="col" colspan="1"
                                    class=" bg-gray-300 border border-l-2 border-t-2   border-gray-400   px-6 py-3">
                                    Juz</th>
                                    <th scope="col" colspan="1"
                                    class=" bg-gray-300 border border-l-2 border-t-2   border-gray-400   px-6 py-3">
                                    Page</th>
                                    <th scope="col" colspan="1"
                                    class=" bg-gray-300 border border-l-2 border-t-2  border-r-2 border-gray-400  px-6 py-3">
                                    Ayat</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @php
                            $currentDate = null;
                        @endphp
                                                  @forelse ($classdata as $data)

                                                  @php
                                                  $date = date('d-m-Y', strtotime($data->created_at));
                                                  $day = date('l', strtotime($data->created_at));
                                          
                                                  // Display the date only if it's different from the previous row
                                                  if ($date !== $currentDate) {
                                                      $currentDate = $date;
                                              @endphp
                                              
                            <tr>
                                        <th colspan="6" class="bg-blue-200 border border-l-2 border-t-2 border-gray-400 text-center">
                    {{ $day }}, {{ $date }}
                </th>
                                        </tr>
                                        @php
                                    }
                                @endphp
                            <tr>

                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $loop->iteration }}</th>
                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $data->student->name }}</th>
                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $data->TasmiSurahId}}
                                    </th>
                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $data->TasmiSurahJuz }}</th>
                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $data->TasmiSurahPage }}</th>
                                    <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                                        {{ $data->TasmiSurahAyat }}</th>
                            </tr>

                            @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                
                               <td colspan="7" class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               No results found</td>
                                <td >
                               
                            </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>









            </div>


            <div class="gap-y content">
                <div class="flex-1 -8 mt-4">
                    {!! $classdata->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!}
                </div>
            </div>

       



        </div>
    </div>


</x-teacher-layout>
