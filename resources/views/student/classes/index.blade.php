<x-teacher-layout>
    <x-slot name="header">
       
    </x-slot>

    <div>
        <div class="p-5 sm:ml-64">

            <h2 class="mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Management') }}
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

     <div class="overflow-y-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                   
                </thead>
                <tbody>
                    @foreach ($userdata as $data )
                        
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="h-auto max-w-40" src="{{ Auth::user()->profile_photo_url }}" >
                            <div class="ps-3">
                                <div class="text-xl font-semibold">Name:{{$data->name}}</div>
                                <div class="font-normal text-gray-500">{{$data->email}}</div>
                                <div class="font-normal text-gray-500">{{$data->PhoneNumber}}</div>



                            </div>  
                        </th>
                        <td class="px-6 py-4"><div class="text-base font-semibold">
                           

                        </div>
                        </td>

                      
                  
                    </tr>
                    
                    
                    
@endforeach

                </tbody>
            </table>
     </div>

            <div class="px-6 py-6 pb-4">

            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
 

                

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

    
                        <tr>
                            <th scope="col" class="p-4">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Class Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Class Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mentored by: 
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
                        <tr>

                        </tr>
                        @forelse ($classdata as $data)
                                <tr
                                
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td 
                                        class="px-6 py-12 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->class->ClassName }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $data->class->ClassDesc }}

                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $data->class->user->name }}

                                    </td>
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
                                            <form action="{{route('student.classes.view',['id'=> Crypt::encrypt($data->EnrollClassId)])}}">
                                                 
                                                <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    View Class</button>
                                            </form>

                                            <form action="{{route('student.classes.viewRecord',[ 'ClassId' =>  Crypt::encrypt($data->EnrollClassId), 'id' => Crypt::encrypt(Auth::id())])}}">
                                                 
                                                <button type="submit" class="ml-2 px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    View Record</button>
                                            </form>

                                            @if ($data->EnrollStatus == 1)
                                            <div class="px-2">

                                             <form action="{{route('student.enroll.destroy',[ 'ClassId' =>  $data->EnrollClassId, 'id' => Auth::id() ])}}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                    class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    Unenroll</button>
                                            </form>

                                            </div>
                                          
                                        @else
                                       <div class="px-2">

                                             <form action="{{route('student.enroll.destroy',[ 'ClassId' =>  $data->EnrollClassId, 'id' => Auth::id() ])}}"
                                                method="post">
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                    class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    Enroll</button>
                                            </form>
                                            
                                            </div>
                                        @endif

                                         
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td></td><td></td>
                                    <td 
                                    class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   No results found
                                </td>
                                </tr>
                            </form>
                        @endforelse

                    </tbody>


                </table>


            </div>


            <div class="gap-y content">
                <div class="flex-1 -8 mt-4">
                    {{-- {!! $userdata->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!} --}}
                </div>
            </div>



        </div></div>

</x-teacher-layout>
