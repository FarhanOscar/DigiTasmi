<x-teacher-layout>
    <x-slot name="header">

    </x-slot>

    <div>
        <div class="p-4 sm:ml-64 mt-6">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Surah Tracker') }}
            </h2>


            <div class="relative overflow-x-auto shadow-md flex items-center justify-center text-white bg-gradient-to-r from-white via-white to-gray-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <div class="w-84 flex flex-row items-center"> <!-- Updated to flex container with row layout -->
            
                    <img src="{{ asset('storage\digitasmi-logo.png') }}" class="size-1/4 w-32" alt="Example Image"> <!-- Adjusted width -->
            
                    <h5 class="text-right text-gray-950 ml-4 text-2xl" > <!-- Added ml-4 for spacing -->
                        Embark on the journey of self-discovery through the Quran.
                    </h5>
            
                </div>
            </div>
            

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
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Memorized Ayat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Ayat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Progress
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deadline
                            </th>
                            <th class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                        <div id="app">
                            @forelse ($surahdata as $data)
                                <form id="tracker" class="max-w-sm mx-auto"
                                    action="{{ route('student.tracker.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td
                                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $data->SurahName }}
                                            <input type="text" name="TrackerSurahId" value="{{ $data->id }}"
                                                readonly class="hidden">

                                        </td>
                                        <td class="px-2 py-3">
                                            <label for="dataSelector_{{ $data->id }}" class="sr-only">Underline
                                                select</label>
                                            <select id="dataSelector_{{ $data->id }}" name="TrackerStatus"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                <optgroup label="---Current Status---"
                                                    class="inline-flex items-center bg-gray-100 text-green-800 font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    <option
                                                        value=" {{ $data->tracker->TrackerStatus ?? 'Not Started' }}">
                                                        {{ $data->tracker->TrackerStatus ?? 'Not Started' }} </option>

                                                </optgroup>

                                                <optgroup
                                                    class="inline-flex items-center bg-gray-100 text-green-800 font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                                                    label="---Default---">

                                                    <option value="Not Started"> Not Started</option>

                                                </optgroup>

                                                <optgroup
                                                    class="inline-flex items-center bg-blue-100 text-green-800 font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                                                    label="---Ongoing---">
                                                    <option value="Reading">Reading</option>
                                                    <option value="Memorising">Memorising</option>
                                                    <option value="Reviewing">Reviewing</option>

                                                </optgroup>

                                                <optgroup
                                                    class="inline-flex items-center bg-green-100 text-green-800 font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                                                    label="---Done---">

                                                    <option value="Memorised + Tafsir">Memorised + Tafsir</option>
                                                    <option value="Memorised">Memorised</option>
                                                </optgroup>


                                            </select>


                                        </td>
                                        <div class="row" data-id="{{ $data->id }}">
                                            <td>

                                                <input type="number" min="0" max="{{ $data->SurahMaxAyat }}"
                                                 name="TrackerSurahAyat"
                                                    data-id="{{ $data->id }}"
                                                    value="{{ $data->tracker->TrackerSurahAyat ?? '' }}"
                                                    class="TrackerSurahAyat bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-5 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                            </td>


                                            <td class="px-6 py-3">
                                                <input type="text" id="selectedMaxAyat_{{ $data->id }}"
                                                    data-id="{{ $data->id }}" name="selectedMaxAyat" disabled
                                                    class= "MaxAyat bg-white  border-white text-gray-900 text-sm rounded-lg "
                                                    value=" {{ $data->SurahMaxAyat }}">

                                            </td>



                                            <td scope="col" class=" py-3">
                                                <div class="progress-bar-container" data-id="{{ $data->id }}">

                                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                                        <div class="progress-bar bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                                            style="width:  {{ $data->tracker && $data->tracker->TrackerSurahAyat !== null ? round(($data->tracker->TrackerSurahAyat / $data->SurahMaxAyat) * 100) : '0' }}%">
                                                            {{ $data->tracker && $data->tracker->TrackerSurahAyat !== null ? round(($data->tracker->TrackerSurahAyat / $data->SurahMaxAyat) * 100) : '0' }}%

                                                        </div>
                                                    </div>

                                                </div>

                                            </td>
                                        </div>
                                        <td scope="col" class="px-6 py-3">


                                            <div class="relative max-w-sm">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input datepicker required type="text" name="TrackerDeadLine"
                                                    value="{{ $data->tracker->TrackerDeadLine ?? 'Select Date' }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Select date">
                                            </div>


                                        </td>
                                        <td>
                                            <button type="submit" id="myButton_{{ $data->id }}" data-id="{{ $data->id }}"
                                                class="submit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto ml-4 px-2 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Submit
                                            </button>
                            </form>

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



                        </div>

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


<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>



<script>

    //Js for ProgressBar
    $(document).ready(function() {
        $(".TrackerSurahAyat").on("input", function() {
            var rowId = $(this).data("id");
            var progId = $(this).data("id");
            var inputValue = $(this).val();
            var MaxAyat = parseInt($(".MaxAyat[data-id='" + rowId + "']").val(), 10);

            var rawPercentage = (inputValue / MaxAyat) * 100;
            var roundedPercentage = rawPercentage.toFixed();

            // Update the progress bar and percentage in the HTML for the current row
            updateProgressBar(rowId, progId, roundedPercentage);
        });

        // Function to update the progress bar and percentage in the HTML for the current row
        function updateProgressBar(rowId, progId, percentage) {
            // var rowBar = $(".row[data-id='" + rowId + "']");
            var progressBarContainer = $(".progress-bar-container[data-id='" + progId + "']");
            var progressBar = progressBarContainer.find(".progress-bar");


            // Update the width of the progress bar
            progressBar.css("width", percentage + "%");
            progressBar.text(percentage + "%");

            console.log(rowId);
            console.log(percentage);
            console.log("Row ID: " + rowId);
            console.log("Progress Bar Container: ", progressBarContainer);


            if (percentage > 100) {

                progressBar.css("width", 100 + "%");
                progressBar.text(100 + "%");


            }

            // Update the text content of the percentage element
        }
    });
</script>
