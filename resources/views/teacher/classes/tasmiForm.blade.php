<x-teacher-layout>
    <x-slot name="header">
       
    </x-slot>

   

        {{-- action="{{route('admin.users.createStudentId',$userdata->id) }}" --}}
        <div class="overflow-y-auto p-5 sm:ml-64">
            <div >
                <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Add New Record: ') }}{{$user->name}}
                </h2>

                <div class="p-4 sm:ml-64">
    
                </div>

           


      

                <div class="flex-1 w-full overflow-x-auto text-sm sm:text-base text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <div class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"></div>
                
                    <div class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <div>
                                <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <form class="max-w-md mx-auto" action="{{ route('teacher.tasmi.store') }}" method="post" id="filterForm" name="filterForm">
                                        {{ csrf_field() }}
                
                                        <div id="app">
                                            @csrf
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Surah:</label>
                                            <div class="py-2">
                                                <select v-model="selectedFilter" name="TasmiSurah" required>
                                                    @foreach ($lessondata->sortBy('sequences') as $lesson)
                                                        <option value="{{ $lesson->id }}" data-max-ayat="{{ $lesson->SurahMaxAyat }}">
                                                            <span class="font-bold">{{ $lesson->SurahName }}</span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                
                                            <div>
                                                <label for="page" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Juz</label>
                                                <div class="py-2">
                                                    <input name="inputJuz" v-model="inputJuz" type="text" id="juz"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        :placeholder="'Juz Between: ' + selectedMinJuz + ' ~ ' + selectedMaxJuz" required>
                                                </div>
                                            </div>
                
                                            <div>
                                                <label for="page" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Page</label>
                                                <div class="py-2">
                                                    <input name="inputPage" v-model="inputPage" type="text" id="page"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        :placeholder="'Page Between: ' + selectedMinPage + ' ~ ' + selectedMaxPage" required>
                                                </div>
                                            </div>
                
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Ayat</label>
                                                <div class="py-2">
                                                    <input v-model="inputAyat" type="text" name="inputAyat"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        :placeholder="'max Ayat: ' + selectedMaxAyat" required>
                                                </div>
                                            </div>
                
                                            <input type="text" name="TasmiStudentId" value="{{ $id }}" readonly class="hidden">
                                            <input type="text" name="TasmiClassId" value="{{ $ClassId }}" readonly class="hidden">
                
                                            <div class="py-12 ">
                                                <button @click="submitForm" type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                
                            <div class="px-4"></div>
                        </div>
                    </div>
                </div>
                
 


      

  <div class="pt-8 ">
<div>
    
</div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Student Record') }}
        </h2>
        <div class="p-4 sm:ml-64">
    
        </div>
    
    
    <div class="overflow-x-auto">
  
               
                

                       

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
      
   </div>
</div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

        <script>
            new Vue({
                el: '#app',
                data: {
                    lessondata: @json($lessondata),
                    selectedFilter: null,
                    inputAyat: '',
                    inputPage: '',
                    inputJuz: ''

                },
                computed: {
                    selectedMaxAyat: function() {
                        if (this.selectedFilter !== null) {
                            var selectedOption = this.lessondata.find(lesson => lesson.id == this.selectedFilter);
                            return selectedOption ? selectedOption.SurahMaxAyat : '';
                        }
                        return '';
                    },

                    selectedMaxPage: function() {
                        if (this.selectedFilter !== null) {
                            var selectedOption = this.lessondata.find(lesson => lesson.id == this.selectedFilter);
                            return selectedOption ? selectedOption.SurahMaxPage : '';
                        }
                        return '';
                    },

                    selectedMinPage: function() {
                        if (this.selectedFilter !== null) {
                            var selectedOption = this.lessondata.find(lesson => lesson.id == this.selectedFilter);
                            return selectedOption ? selectedOption.SurahMinPage : '';
                        }
                        return '';
                    },

                    selectedMaxJuz: function() {
                        if (this.selectedFilter !== null) {
                            var selectedOption = this.lessondata.find(lesson => lesson.id == this.selectedFilter);
                            return selectedOption ? selectedOption.SurahMaxJuz : '';
                        }
                        return '';
                    },

                    selectedMinJuz: function() {
                        if (this.selectedFilter !== null) {
                            var selectedOption = this.lessondata.find(lesson => lesson.id == this.selectedFilter);
                            return selectedOption ? selectedOption.SurahMinJuz : '';
                        }
                        return '';
                    }

                },
                methods: {
                    submitForm: function(event  ) {
                      event.preventDefault();

                        // Function to check Ayat condition
                        var isAyatConditionMet = this.checkAyatCondition();

                        // Function to check Page condition
                        var isPageConditionMet = this.checkPageCondition();

                        var isJuzConditionMet = this.checkJuzCondition();


                        // If both conditions are met, submit the form
                        if (isAyatConditionMet && isPageConditionMet && isJuzConditionMet) {
                          console.log('Succesfully submit');
                          document.getElementById('filterForm').submit();
                        }
                    },

                    checkAyatCondition: function() {
                        var inputAyat = parseInt(this.inputAyat);
                        var selectedMaxAyat = parseInt(this.selectedMaxAyat);

                        if (!isNaN(inputAyat) && inputAyat <= selectedMaxAyat) {
                            return true;
                        } else {
                            alert('Input Ayat should be less than or equal to Maximum Ayat of a Surah');
                            console.log('Ayat invalid');
                            return false;
                        }
                    },

                    checkPageCondition: function() {
                        var inputPage = parseInt(this.inputPage);
                        var surahMinPage = parseInt(this.selectedMinPage);
                        var surahMaxPage = parseInt(this.selectedMaxPage);

                        if (!isNaN(inputPage) && inputPage >= surahMinPage && inputPage <= surahMaxPage) {

                            return true;
                        } else {
                            alert('Page not valid for the surah');
                            console.log('Page invalid');

                            return false;
                        }
                    },

                    checkJuzCondition: function() {
                        var inputJuz = parseInt(this.inputJuz);
                        var surahMinJuz = parseInt(this.selectedMinJuz);
                        var surahMaxJuz = parseInt(this.selectedMaxJuz);

                        if (!isNaN(inputJuz) && inputJuz >= surahMinJuz && inputJuz <= surahMaxJuz) {
                          
                            return true;
                        } else {
                            alert('Juz not valid for the surah');
                            console.log('Juz invalid');

                            return false;
                        }
                    }


                }

            });
        </script>







</x-teacher-layout>
