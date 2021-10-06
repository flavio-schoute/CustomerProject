<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <x-jet-application-logo class="block h-12 w-auto"/>
                    </div>

                    <div class="mt-8 text-2xl">
                        Welkom {{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
