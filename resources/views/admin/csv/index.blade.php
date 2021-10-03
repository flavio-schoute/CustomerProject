<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leerlingen importeren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if(isset($errors) && $errors->any())
                    <div>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="user-file">

                    <button type="submit" class="btn btn-">Leerlingen importeren</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
