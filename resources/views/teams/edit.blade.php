<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Muuda meeskonna infot') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('teams.update', $team) }}">
                        @csrf
                        @method('patch')
                        <div class="columns-1 lg:columns-2">
                            <div>
                                <x-input-label for="team_name" value="Meeskonna nimi" />
                                <x-text-input name="team_name" value="{{ old('team_name', $team->team_name) }}" />
                                <x-input-error :messages="$errors->get('team_name')" class="mt-2" />

                                <x-input-label for="short_name" value="3 tähega lühend" />
                                <x-text-input name="short_name" value="{{ old('short_name', $team->short_name) }}" />
                                <x-input-error :messages="$errors->get('short_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="coach" value="Treener" />
                                <x-text-input name="coach" value="{{ old('coach', $team->coach) }}" />
                                <x-input-error :messages="$errors->get('coach')" class="mt-2" />

                                <x-input-label for="contact_nr" value="Kontakt number" />
                                <x-text-input name="contact_nr" value="{{ old('contact_nr', $team->contact_nr) }}" />
                                <x-input-error :messages="$errors->get('contact_nr')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Salvesta meeskonna info') }}</x-primary-button>
                        </div>
                    </form>
                    
                    <x-input-label for="players" value="Mängijad" class="text-2xl py-4" />
                        @foreach ($team->players as $player)
                        
                            <div class="flex border-b justify-between items-center">
                            <p>{{ $player->first_name }} {{ $player->last_name }}<p>
                            <div>
                                <form method="POST" action="{{ route('team.detach.player', $team) }}">
                                    
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" value="{{$player->id}}" name="player_id">
                                    <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                                        Eemalda
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                        
                    @endforeach
                    <form method="POST" action="{{ route('team.attach.player', $team) }}">
                        @csrf
                        @method('post')
                        
                        <x-input-label for="player_id" value="Lisa mängijad:" class="text-2xl py-4" />
                        <select name="player_id[]" id="player_id" multiple
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option></option>
                            @foreach ($players as $player)
                            <option value="{{ $player->id }}">{{ $player->first_name }} {{ $player->last_name }}</option>
                            @endforeach
                        </select>

                        <div class="mt-4 space-x-2">
                            <x-primary-button>
                                {{ __('Lisa') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="mt-4 space-x-2">
                        <a href="{{ route('teams.index') }}">{{ __('Tagasi') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>