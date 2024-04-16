<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Muuda mängija infot') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('players.update', $player) }}">
                        @csrf
                        @method('patch')
                        <x-input-label for="first_name" value="Eesnimi" />
                        <x-text-input name="first_name" value="{{ old('first_name', $player->first_name) }}" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        
                        <x-input-label for="last_name" value="Perekonnanimi" />
                        <x-text-input name="last_name" value="{{ old('last_name', $player->last_name) }}" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        
                        <x-input-label for="jersey_nr" value="Särgi number" />
                        <x-text-input name="jersey_nr" value="{{ old('jersey_nr', $player->jersey_nr) }}" />
                        <x-input-error :messages="$errors->get('jersey_nr')" class="mt-2" />

                        <x-input-label for="pos_nr" value="Positsiooni number" />
                        <x-text-input name="pos_nr" value="{{ old('pos_nr', $player->pos_nr) }}" />
                        <x-input-error :messages="$errors->get('pos_nr')" class="mt-2" />

                        <x-input-label for="birth_date" value="Sünniaeg" />
                        <x-text-input name="birth_date" value="{{ old('birth_date', $player->birth_date) }}" />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />

                        <x-input-label for="height" value="Pikkus" />
                        <x-text-input name="height" value="{{ old('height', $player->height) }}" />
                        <x-input-error :messages="$errors->get('height')" class="mt-2" />

                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Salvesta') }}</x-primary-button>
                            <a href="{{ route('players.index') }}">{{ __('Tühista') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>