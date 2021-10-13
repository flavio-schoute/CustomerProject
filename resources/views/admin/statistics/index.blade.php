<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiek') }}
        </h2>
    </x-slot>
    @push('scripts')

    <script src="{{ $pieChart->cdn() }}"></script>
    <script src="{{ $barChart->cdn() }}"></script>

    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                      
                    </div>

                    <div class="mt-8 text-2xl">
                        {!! $pieChart->container() !!}
                        {{ $pieChart->script() }}

                        {!! $barChart->container() !!}
                        {{ $barChart->script() }}
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</x-app-layout>
