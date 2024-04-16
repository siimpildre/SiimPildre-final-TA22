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