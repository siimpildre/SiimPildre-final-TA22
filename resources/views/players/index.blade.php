<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mängijad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            @foreach ($players as $player)
                            <tr class="border-b justify-between items-center text-center transition duration-300 ease-in-out hover:bg-neutral-100">   
                                <td>
                                    <a href="{{ route('players.show', $player) }}">
                                        {{ $player->first_name }}
                                    </a>
                                </td>
                                <td>{{ $player->last_name }}</td>
                                <td>{{ $player->jersey_nr }}</td>
                                <td>{{ $player->pos_nr }}</td>
                                <td>{{ $player->birth_date }}</td>
                                <td>{{ $player->height }}</td>

                                <td>
                                    <a href="{{ route('players.edit', $player) }}">
                                        {{ __('Muuda') }}
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('players.destroy', $player) }}">

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
          {{ $players->links() }}
        </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>