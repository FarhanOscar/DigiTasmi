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

        @if (session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="error">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Error</span>
            <div>
                <span class="font-medium">Error!</span>{{ session('error') }}
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
     <div class=" bg-white overflow-y-auto">

        <div class="w-full pr-1.5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <div class="text-xs text-gray-700 uppercase  dark:bg-gray-700 dark:text-gray-400">
                <div class=" w-full pr-16 flex items-center p-4">
                            <form action="{{ route('admin.classes.index') }}" method="get" id="searchForm" class="flex items-center">
                                <div class="relative mt-1">
                                    <input type="text" id="search" name="search" class="block p-2.5 ms-2 pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Class...">
                                </div>
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </button>
                            </form>
                    </div>
                </div>
            </div>

            

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

             
               

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
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
                        Created by: 
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
                        {{ csrf_field() }}
                        <tr
                        
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td 
                                class="px-6 py-12 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data->ClassName }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->ClassDesc }}

                            </td>

                            <td class="px-6 py-4">
                                {{ $data->user->name }}

                            </td>


                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <form action="{{ route('admin.classes.show',  ['ClassId' =>  Crypt::encrypt($data->id), 'ClassMakerId' => Crypt::encrypt($data->ClassMakerId)]) }}">
                                         
                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Manage Class</button>
                                    </form>

                                    <div class="px-2">

                                        <form action="{{ route('admin.classes.pdf',  ['ClassId'=>Crypt::encrypt($data->id)]) }} " method="GET">
                                         
                                            <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                View Class Record</button>
                                        </form>
                                    </div>

                                 

                                    <div class="px-2">
                                        <form
                                            action="{{ route('admin.classes.deleteClass', ['ClassId' =>  $data->id, 'ClassMakerId' => $data->ClassMakerId]) }} " method="POST"
                                             >
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" >
                                                Delete Class</button>
                                        </form>
                                    </div>
                                </div>
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
                
                @endforelse

            </tbody>


        </table>
     </div>

     <div class="gap-y content">
        <div class="flex-1 -8 mt-4">
            {!! $classdata->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!}
        </div>
    </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
 




            </div>


            <div class="gap-y content">
                <div class="flex-1 -8 mt-4">
                    {{-- {!! $userdata->withQueryString()->onEachSide(1)->links('pagination::tailwind') !!} --}}
                </div>
            </div>



        </div></div>

</x-teacher-layout>
