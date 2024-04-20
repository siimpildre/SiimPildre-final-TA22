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
                    <!-- Register team -->
                    <form method="POST" action="{{ route('teams.store') }}">
                        @csrf
                        <h2 class="font-semibold mt-6 text-xl text-gray-800 leading-tight">
                            {{ __('Lisa uus meeskond') }}
                        </h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Team name -->
                            <div class="mt-4">
                                <x-input-label for="team_name" :value="__('Meeskonnanimi')" />
                                <x-text-input id="team_name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="team_name" 
                                                :value="old('team_name')"/>
                                <x-input-error :messages="$errors->get('team_name')" class="mt-2" />
                            </div>

                            <!-- Short team name -->
                            <div class="mt-4">
                                <x-input-label for="short_name" :value="__('3-täheline lühend')" />
                                <x-text-input id="short_name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="short_name" 
                                                :value="old('short_name')"/>
                                <x-input-error :messages="$errors->get('short_name')" class="mt-2" />
                            </div>

                            <!-- Coach name -->
                            <div class="mt-4">
                                <x-input-label for="coach" :value="__('Treener')" />

                                <x-text-input id="coach" class="block mt-1 w-full"
                                                type="text"
                                                name="coach"
                                                :value="old('coach')"/>
                                <x-input-error :messages="$errors->get('coach')" class="mt-2" />
                            </div>

                            <!-- Contact number -->
                            <div class="mt-4">
                                <x-input-label for="contact_nr" :value="__('Kontaktnumber')" />

                                <x-text-input id="contact_nr" class="block mt-1 w-full"
                                                type="tel"
                                                name="contact_nr"
                                                :value="old('contact_nr')"/>
                                <x-input-error :messages="$errors->get('contact_nr')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Lisa') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <!-- Teams list -->                    
                    <table class="relative w-full">
                        <thead class="bg-neutral-100 text-left">
                            <tr>
                                <th>Meeskonnanimi</th>
                                <th>Lühend</th>
                                <th class="hidden lg:table-cell">Treener</th>
                                <th class="hidden lg:table-cell">Kontakt</th>
                                <th></th>
                                <th class="hidden lg:table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                            <tr class="border-b justify-between items-center text-left transition duration-300 ease-in-out hover:bg-neutral-100">   
                                <td>
                                    <a href="{{ route('teams.show', $team) }}">
                                        {{ $team->team_name }}
                                    </a>
                                </td>
                                <td>{{ $team->short_name }}</td>
                                <td class="hidden lg:table-cell">{{ $team->coach }}</td>
                                <td class="hidden lg:table-cell">{{ $team->contact_nr }}</td>
                                <td>
                                    <a class="text-green-800" href="{{ route('teams.edit', $team) }}">
                                        {{ __('Muuda') }}
                                    </a>
                                </td>
                                <td class="hidden lg:table-cell">
                                    <form method="POST" action="{{ route('teams.destroy', $team) }}">

                                        @csrf

                                        @method('delete')
                                        <x-danger-button class="text-red-500" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Kustuta
                                        </x-danger-button>
                                
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <div class="pt-4">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</x-app-layout>