<x-teacher-layout>
    <x-slot name="header">
      
    </x-slot>

    <div class="overflow-y-auto overflow-x-auto">
        <div class="p-5 sm:ml-64">

            <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Info') }}
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

        <div class="w-full pr-1 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            @foreach ($classdata as $data)
                <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 flex-row items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <form class="mx-auto" action="{{ route('teacher.classes.update', $data->id) }}" method="POST">
                        
                        @method('PUT')
                        @csrf
                        <div class="mb-5">
                            <label for="ClassName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Name:</label>
                            <input type="text" id="ClassName" name="ClassName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->ClassName }}">
                        </div>
        
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Description:</label>
                            <textarea id="message" name="ClassDesc" id="ClassDesc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $data->ClassDesc }}</textarea>
        
                            <div class="py-5">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Submit
                                </button>
                            </div>
                    </form>

              
                </div>
            @endforeach
        </div>

    

        
   
    
</div>
        
            
</div>
            {{-- <div class=" p-8 sm:ml-64">

<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Manage Class Surah') }}
</h2>
        <div class="p-5 sm:ml-64">

</div>
        <div class=" w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            @foreach ($classdata as $data)


                <div class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 flex-row items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                   
                   
                    <form  action="">
                       48 Surah Registered
                            <button type="submit" class=" text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Manage Surah
                            </button>
                        
                    </form>
                </div>
            @endforeach
        </div> 
        </div> --}}


        {{-- For Next version, Make Surah can be choose by teacher for their class --}}
        {{-- <div class="p-5 sm:ml-64">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Surah') }}
            </h2>
            <div class="p-4 sm:ml-64">
        
            </div>
        
        
        <div class="overflow-x-auto">
            <div class=" w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                @foreach ($classdata as $data)
    
    
                    <div class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 flex-row items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                       
                       
                        <form  action="">
                           48 Surah Registered
                                <button type="submit" class=" text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Manage Surah
                                </button>
                            
                        </form>
                    </div>
                @endforeach
            </div> 
        </div>
           
            
        </div> --}}



        <div class="p-5 sm:ml-64">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Class Partcipant') }}
    </h2>
    <div class="p-4 sm:ml-64">

    </div>


<div class="overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

            <tr>
                <th scope="col" class="p-4">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Participant Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                
               
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
        
            @forelse ($studentenroll as $data)
              
                    {{ csrf_field() }}
                    <tr
                    
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="{{ $data->user->profile_photo_url }}" alt="Jese image">
                            <div class="ps-8">
                                <div class="text-base font-semibold">{{ $data->user->name }}</div>
                            </div>  
                        </th>
                      

                        <td class="px-6 py-4">
                            @if ($data->EnrollStatus == 0)
                                <span
                                    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                    Not Enrolled
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                    Enrolled
                                </span>
                            @endif

                        </td>


                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <form action="{{ route('teacher.tasmi.show', ['ClassId' =>  Crypt::encrypt($data->EnrollClassId), 'id' => Crypt::encrypt($data->EnrollStudentId)]) }}">
                                     
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Add Records</button>
                                </form>
                                <div class="px-2"> </div>

                                <form action="{{ route('teacher.tasmi.showRecord', ['ClassId' => Crypt::encrypt($data->EnrollClassId), 'id' => Crypt::encrypt($data->EnrollStudentId)]) }}">
                                     
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        View Records</button>
                                </form>

                                <div class="px-2"> </div>

                                <form action="{{ route('teacher.tasmi.destroy', ['ClassId' =>  Crypt::encrypt($data->EnrollClassId), 'id' => Crypt::encrypt($data->EnrollStudentId)]) }}" method="post">
                                  @csrf
                                   @method('DELETE')
                                     
                                    <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" >
                                        Remove Students</button>
                                </form>
                                
                                
                            
                                
                            </div>
                        </td>
                    </tr>
                    

                    @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        
                        <td></td><td class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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

</x-teacher-layout>

     