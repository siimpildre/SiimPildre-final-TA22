<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $schedule->team1->team_name  . ' vs ' . $schedule->team2->team_name  . ' ' . date('d.m.Y', strtotime($schedule->date)) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <li>
                        <x-input-label for="title" value="Eesnimi" />
                        {{ old('title', $player->first_name) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="Perekonnanimi" />
                        {{ old('title', $player->last_name) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="Särgi number" />
                        {{ old('title', $player->jersey_nr) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="Positsioon" />
                        {{ old('title', $player->pos_nr) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="Sünniaeg" />
                        {{ old('title', $player->birth_date) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="Pikkus" />
                        {{ old('title', $player->height) }}
                        </li>
                        <div class="mt-4 space-x-2">
                            <a href="{{ route('schedules.index') }}">{{ __('Tagasi') }}</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>