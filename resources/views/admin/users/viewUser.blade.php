<x-teacher-layout>
    <x-slot name="header">

    </x-slot>

    <div>
        <div class="p-5 sm:ml-64">

            <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight ">
                {{ __('Class Info') }}
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
                        @foreach ($userdata as $data)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="h-auto max-w-40" src="{{ $data->profile_photo_url }}">
                                    <div class="ps-3">
                                        <div class="text-xl font-semibold">Name:{{ $data->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $data->email }}</div>
                                        <div class="font-normal text-gray-500">{{ $data->PhoneNumber }}</div>

                                        <div class="mt-10">
                                            @if ($data->id == Auth::user()->id)
                                                <button type="button"
                                                    class="text-white bg-red-400 dark:bg-red-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                    disabled>Remove User</button>
                                            @else
                                                <form action="{{ route('admin.users.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Remove
                                                        User </button>

                                                </form>
                                            @endif

                                        </div>




                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">


                                    </div>
                                </td>



                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            @if ($data->role_id == 2)

                <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight ">
                    {{ __('Class Joined') }}
                </h2>

                <div class="overflow-y-auto">

                    <table class="mt-4 mb-4 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">

                            <tr>
                                <th scope="col" class="p-4">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Class Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created By:
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($studentclass as $data)
                                {{ csrf_field() }}
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->class->ClassName }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->class->user->name }}
                                    </th>

                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                        <div class="flex items-center">

                                            <form action="{{ route('admin.users.showRecord', ['ClassId' =>  Crypt::encrypt($data->EnrollClassId), 'id' => Crypt::encrypt($data->EnrollStudentId)]) }}">

                                            <button type="submit"
                                                class="px-3 mr-2 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                View Record </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.users.removeEnroll', ['ClassId' =>  $data->EnrollClassId, 'id' => $data->EnrollStudentId]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class=" px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Remove from Class </button>
                                        </form>
                                        </div>



                                    </th>




                                </tr>


                            @empty
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


                                    <td colspan="4"
                                        class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No results found</td>
                                    <td>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>


                    </table>
                </div>


            @endif

            @if ($data->role_id == 3)

                <h2 class=" mt-4 mb-4 font-semibold text-xl text-gray-800 leading-tight ">
                    {{ __('Class Created') }}
                </h2>

                <div class="overflow-y-auto">

                    <table class="mt-4 mb-4 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">

                            <tr>
                                <th scope="col" class="p-4">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Class Name
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($teacherclass as $data)
                                {{ csrf_field() }}
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $data->ClassName }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <form action="{{ route('admin.users.removeEnroll', ['ClassId' =>  $data->id, 'id' => $data->ClassMakerId]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class=" px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Remove  Class </button>
                                        </form>
                                    </th>







                                </tr>


                            @empty
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                    <td></td>
                                    <td
                                        class=" text-center px-6 py-8 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No results found</td>
                                    <td>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>


                    </table>
                </div>

            @endif






            <h2 class="mt-4 mb-2  font-semibold text-xl text-gray-800 leading-tight">
                {{-- {{ __('Class Partcipant') }} --}}
            </h2>


            <div class=" overflow-y-auto">


            </div>


        </div>





    </div>

</x-teacher-layout>

{{-- @foreach ($classdata as $data)

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
