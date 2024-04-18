<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->team_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul>
                        <li>
                        <x-input-label for="title" value="Meeskonnanimi" />
                        {{ old('title', $team->team_name ) }}
                        </li>
                        <li>
                        <x-input-label for="title" value="3-tähega lühend" />
                        {{ old('title', $team->short_name ) }}
                        </li>
                        <x-input-label for="title" value="Treener" />
                        {{ old('title', $team->coach ) }}
                        </li>
                        <x-input-label for="title" value="Kontakt number" />
                        {{ old('title', $team->contact_nr ) }}
                        </li>
                        <div class="mt-4 space-x-2">
                            <a href="{{ route('teams.index') }}">{{ __('Tagasi') }}</a>
                        </div>
                    </ul>
                </div>
                <div>
                    <div class="p-6 text-gray-900">
                        <table class="relative w-full">
                            <thead class="bg-neutral-100 text-left">
                                <tr>
                                    <th>Eesnimi</th>
                                    <th>Perekonnanimi</th>
                                    <th>Särgi number</th>
                                    <th>Positsiooni number</th>
                                    <th>Sünniaeg</th>
                                    <th>Pikkus</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>