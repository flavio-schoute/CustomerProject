<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts aanmaken') }}
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

                <div>
                    <form action="{{ route('admin.create_account.store') }}" method="POST" x-data="{role_id: 1}">
                        @csrf
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first_name"
                                           class="block text-sm font-medium text-gray-700">Voornaam</label>
                                    <input type="text" name="first_name" id="first_name" autocomplete="first_name" value="{{ old('first_name') }}"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lastname"
                                           class="block text-sm font-medium text-gray-700">Achternaam</label>
                                    <input type="text" name="last_name" id="last_name" autocomplete="last_name" value="{{ old('last_name') }}"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password"
                                           class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                                    <input type="password" name="password" id="password"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Wachtwoord
                                        opnieuw</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <input type="text" name="email" id="email" autocomplete="email" value="{{ old('email') }}"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>


                                <div class="col-span-6 sm:col-span-3">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                                    <select id="role_id" name="role_id" autocomplete="role" x-model="role_id"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-span-4" id="groupdiv" x-show="role_id == 3">

                                    <label for="group" class="block text-sm font-medium text-gray-700">Klas</label>
                                    <select id="group_id" name="group_id" autocomplete="group_id" x-model="group_id"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-3" id="phonediv" x-show="role_id == 2">
                                    <label for="phonenumber" class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
                                    <input type="text" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-3 sm:col-span-3 lg:col-span-2" id="datediv" x-show="role_id == 3">
                                    <label for="birthdate"
                                           class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                                    <input type="date" name="birthdate" id="birthdate"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <button type="submit"
                                        class="col-span-5 text-center text-black-400 font-bold rounded py-2 w-2/12 focus:outline-none bg-white-900 border-2 border-black-800">
                                    Registreer gebruiker
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
