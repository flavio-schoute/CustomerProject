<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leerlingen importeren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                @if(session('success'))
                    <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if(session()->has('failures'))
                    <table>
                        <tr>
                            <td>Row</td>
                            <td>Attribute</td>
                            <td>Errors</td>
                            <td>Value</td>
                        </tr>

                        @foreach(session()->get('failures') as $validation)
                            <tr>
                                <td>{{ $validation->row() }}</td>
                                <td>{{ $validation->attribute() }}</td>
                                <td>
                                    <ul>
                                        @foreach($validation->errors() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $validation->values()[$validation->attribute()] }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif

                    <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data" class="my-8">
                        @csrf

                        <div>
                            <div class="flex items-center mb-5">
                                <label for="number" class="w-20 mr-6 text-right font-bold text-gray-600">Bestand:</label>
                                <input type="file" id="file" name="user-file" placeholder="file" accept=".xlsx" class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 text-gray-600 placeholder-gray-400 outline-none">
                            </div>

                            <div>
                                <button class="py-3 px-8 bg-green-400 text-white font-bold">Submit</button>
                            </div>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</x-app-layout>
