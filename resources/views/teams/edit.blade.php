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
                        <x-input-label for="team_name" value="Meeskonna nimi" />
                        <x-text-input name="team_name" value="{{ old('team_name', $team->team_name) }}" />
                        <x-input-error :messages="$errors->get('team_name')" class="mt-2" />

                        <x-input-label for="short_name" value="3 tähega lühend" />
                        <x-text-input name="short_name" value="{{ old('short_name', $team->short_name) }}" />
                        <x-input-error :messages="$errors->get('short_name')" class="mt-2" />
                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Salvesta') }}</x-primary-button>
                            <a href="{{ route('teams.index') }}">{{ __('Tühista') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>