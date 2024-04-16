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
                        <div class="mt-4 space-x-2">
                            <a href="{{ route('teams.index') }}">{{ __('Tagasi') }}</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>