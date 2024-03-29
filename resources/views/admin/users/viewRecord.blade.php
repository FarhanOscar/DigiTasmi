<x-teacher-layout>
    <x-slot name="header">


    </x-slot>


    <header>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    </header>

    <div class="overflow-y-auto p-8 sm:ml-64">
<div >

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        </h2>



        <div class=" grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
          <div class="w-full bg-white  p-4 md:p-6">


              <div class="lg:flex justify-between">
                <div class="lg:mr-4">
                        
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Student Profile</h5>
                    <img class="mt-4 h-auto max-w-48" src="{{ $userdata->profile_photo_url }}" alt="Profile Image">
</div>
              
<div class=" mr-36 lg:mt-4 pr-12 ">
  <div class="lg:pt-24  pr-24 text-left text-2xl font-semibold">{{ $userdata->name }}</div>
                        <div class="text-left  font-semibold text-gray-500">{{ $userdata->PhoneNumber }}</div>
                        <div class="text-left  font-semibold text-gray-500">{{ $userdata->ClassName }}</div>
                    </div>
            </div>                 


              





            </div>
            <div>
                <div class="w-full bg-white  p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Performance</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Overall performance</p>
                        </div>
                        <div
                            class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                           
                           
                        </div>
                    </div>

                    <!-- Area-Chart  -->
                    <div id="area-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <!-- Select -->
                            <div class="w-32">
                                <select
                                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                    name="dataSelector" id="dataSelector">
                                    <option value="TasmiSurahPage">By Page</option>
                                    <option value="TasmiSurahJuz">By Juz</option>
                                </select>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>







    </div>

    </div>

    



 



    <div class="p-5 sm:ml-64">

        <h2 class=" mt-4  font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Student Record') }}
        </h2>
    

        <div >

            <div class="w-full bg-white  lg:relative overflow-x-auto ">
                 <div class=" py-4 flex items-center ">
            <div class=" mx-6  flex items-center space-x-4">
                <span class=" uppercase">Month:</span>
                <form action="">
                  <select name="select1" id="monthSelect" class=" font-semibold mb-2 block text-sm border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value='' selected>--Show All --</option>
                    @foreach ($month as $month)
                        <option value="{{ $month->month }}" {{ $monthselect == $month->month ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $month->month, 10)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="flex items-center space-x-4">
                <span class="uppercase">Year:</span>
                <select name="select2" id="yearSelect" class=" font-semibold mb-2 block text-sm border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($year as $year)
                        <option value="{{ $year->year }}" {{ $yearselect == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-4">
                     <button type="submit" name="action" value="filter" class=" ml-4 mb-2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Filter
            </button>
                </form>
            </div>

      
                
        </div>
            </div>
         
        


       
            <div class="w-full py-4 lg:relative overflow-x-auto ">

        <table class="border border-gray-400 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">

                <tr >
                    <th scope="col" class="border border-gray-400 p-4">
                        #
                    </th>
                
                    <th scope="col" class=" border border-gray-400 px-6 py-3">
                        Surah Name
                    </th>
                    <th scope="col" class="px-6 py-3 border border-gray-400 ">
                        Page
                    </th>

                    <th scope="col" class="px-6 py-3 border border-gray-400">
                        Juz
                    </th>

                    <th scope="col" class="px-6 py-3 border border-gray-400">
                        Ayat
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @php
                $currentDate = null;
            @endphp
                                      @forelse ($tasmiRec as $data)

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
                            {{ $data->surah->SurahName }}</th>
                        <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                            {{ $data->TasmiSurahJuz }}</th>
                        <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                            {{ $data->TasmiSurahPage }}</th>
                        <th scope="col" class=" border border-l-2 border-t-2 border-gray-400 px-6 py-3">
                            {{ $data->TasmiSurahAyat }}</th>
                </tr>

                @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    
                   <td colspan="5" class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
        {!! $tasmiRec->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!}
    </div>
</div>
</div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
        <script>
    
    
    
    
        
              const chartData = @json($chartDataArray);
              console.log('@json($chartDataArray)');
              const selectedDataField = document.getElementById('dataSelector').value;
    
            const options = {
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: 0
                    },
                },
                series: [{
                    name: "Page",
                    data: chartData.map(record => record[selectedDataField]),
                    color: "#1A56DB",
                },
               ],
                xaxis: {
                    categories: chartData.map(record => record.created_at),
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
            }
       if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("area-chart"), options);
                chart.render();
    
      document.getElementById('dataSelector').addEventListener('change', function () {
                const selectedDataField = this.value;
                chart.updateSeries([{
                    name: selectedDataField,
                    data: chartData.map(record => record[selectedDataField]),
                    color: "#1A56DB",
                }]);
            });
    
         
    
              
            }     
       
          
        </script>




</x-teacher-layout>
