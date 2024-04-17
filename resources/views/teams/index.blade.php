<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meeskonnad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul>
 <!-- Register team -->
                    <form method="POST" action="{{ route('teams.store') }}">
                        @csrf

                        <!-- Team name -->
                        <div>
                            <x-input-label for="team_name" :value="__('Meeskonnanimi')" />
                            <x-text-input id="team_name" class="block mt-1 w-full" 
                                            type="text" 
                                            name="team_name" 
                                            :value="old('team_name')" 
                                            required autofocus autocomplete="team_name" />
                            <x-input-error :messages="$errors->get('team_name')" class="mt-2" />
                        </div>

                        <!-- Short team name -->
                        <div class="mt-4">
                            <x-input-label for="short_name" :value="__('3-täheline lühend')" />
                            <x-text-input id="short_name" class="block mt-1 w-full" 
                                            type="text" 
                                            name="short_name" 
                                            :value="old('short_name')" 
                                            required autocomplete="short_name" />
                            <x-input-error :messages="$errors->get('short_name')" class="mt-2" />
                        </div>

                        <!-- Coach name -->
                        <div class="mt-4">
                            <x-input-label for="coach" :value="__('Treener')" />

                            <x-text-input id="coach" class="block mt-1 w-full"
                                            type="text"
                                            name="coach"
                                            required autocomplete="coach" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Contact number -->
                        <div class="mt-4">
                            <x-input-label for="contact_nr" :value="__('Kontaktnumber')" />

                            <x-text-input id="contact_nr" class="block mt-1 w-full"
                                            type="tel"
                                            name="contact_nr" required autocomplete="contact_nr" />
                            <x-input-error :messages="$errors->get('contact_nr')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Registeeri') }}
                            </x-primary-button>
                        </div>
                    </form>

<!-- Teams list -->                    
                        @foreach ($teams as $team)
                        <li>
                            <div class="flex border-b justify-between items-center">

                                <a href="{{ route('teams.show', $team) }}">
                                    <p>{{ $team->team_name }}</p>
                                </a>
                                
                                <p>{{ $team->short_name }}</p>
                                <div class="grid grid-cols-2 gap-2 pt-2">
                                    <a href="{{ route('teams.edit', $team) }}">
                                        {{ __('Muuda') }}
                                    </a>
                                    <form method="POST" action="{{ route('teams.destroy', $team) }}">

                                        @csrf

                                        @method('delete')
                                        <x-danger-button class="text-red-500" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Kustuta
                                        </x-danger-button>

                                    </form>
                                </div>
                            </div>
                        </li>    
                        @endforeach
                    </ul>
                </div>
                {{$teams}}
            </div>
        </div>
    </div>
</x-app-layout>