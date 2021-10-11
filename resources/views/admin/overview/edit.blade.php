<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Studenten overzicht') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
                    <span class="inline-block align-middle mr-8">
                        <b class="capitalize italic block mb-2">Whooops!</b>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </span>
                </div>
            @endif

            <form action="{{ route('admin.overview.update', $user->id) }}" method="POST" x-data="{role_id: {{$user->role_id}}}">
                @csrf
                @method('PUT')

                <div class="mt-4">
                    <x-jet-label for="first_name" value="{{ __('Voornaam') }}"/>
                    <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$user->first_name"/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="last_name" value="{{ __('Achternaam') }}"/>
                    <x-jet-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$user->last_name"/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}"/>
                    <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email"/>
                </div>

                <div class="mt-4" x-show="role_id == 3">
                    <x-jet-label for="group_id" value="{{ __('Klas') }}"/>
                    <select id="group_id" name="group_id" autocomplete="group_id" x-model="group_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4" x-show="role_id == 2">
                    <x-jet-label for="phonenumber" value="{{ __('Telefoon nummer') }}"/>
                    <x-jet-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber"/>
                </div>

                <div class="mt-4" x-show="role_id == 3">
                    <x-jet-label for="birthdate" value="{{ __('Geboortedatum') }}"/>
                    <x-jet-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"/>
                </div>


                <div class="flex items-center justify-center mt-4">
                    <x-jet-button>
                        {{ __('Leerling bewerken opslaan') }}
                    </x-jet-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
