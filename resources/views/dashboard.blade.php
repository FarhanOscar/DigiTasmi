    <x-trial-layout>
   
        <x-slot name="header">
            <div class="flex items-center">
                <img src="{{ asset('storage/digitasmi.svg') }}" class="h-32" alt="Flowbite Logo" />
            </div>
            
                 </x-slot>
    {{-- <div class=" p-4 sm:ml-64 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    Sorry, your free trial has ended, But dont worry, Just email us at farhanyousoff@gmail.com and we will proceed to activate your account
                    <button type="submit" href="{{ route('logout') }}">
                        {{ __('Log Out') }}
                    </button>
                </form>            </div>
        </div>
    </div> --}}

  

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Your 7 day trial has ended</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
            <button type="submit" href="{{ route('logout') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Return to Welcome
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            </form>
          
        </div>
    </div>
</section>


    </x-trial-layout>


