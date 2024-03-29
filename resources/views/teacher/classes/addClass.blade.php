


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

           

        <div class="w-full pr-1 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 flex-row items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <form class="max-w-md mx-auto" action="{{route('teacher.classes.store') }}"   method="post" >
                        @method('POST')
                        @csrf
                        <div class="mb-5">
                            <label for="ClassName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Name:</label>
                            <input type="text" id="ClassName" name="ClassName" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter class name...">
                         </div>
        
                        <div class="py-12">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Description:</label>
                            <textarea id="message" name="ClassDesc" id="ClassDesc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Description..."></textarea>
                            <div class="py-5">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        
            
</div>



              
  
            


    </div>

</x-teacher-layout>

            {{-- @foreach ($classdata as $data )

            <form class="max-w-md mx-auto" action="{{route('teacher.classes.update',$data->id)}}" method="POST" >
                 @method('PUT')
                @csrf


                     <div class="mb-5">
                    <label for="ClassName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Name:</label>
                    <input type="text" id="ClassName" name="ClassName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    value="{{$data->ClassName}}">
                </div>
                
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Description:</label>
                <textarea id="message" name="ClassDesc" id="ClassDesc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                >{{$data->ClassDesc}} </textarea>

                <div class="py-5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
                </div>
   </form>
                @endforeach --}}
               
           