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
                    <div class="mb-8">
                        <form method="POST" action="{{ route('players.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                                <!-- First name -->
                                <div class="mt-4">
                                    <x-input-label for="first_name" :value="__('Eesnimi')" />
                                    <x-text-input id="first_name" class="block mt-1 w-full" 
                                                    type="text" 
                                                    name="first_name" 
                                                    :value="old('first_name')" 
                                                    required autofocus autocomplete="first_name" />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <!-- Last name -->
                                <div class="mt-4">
                                    <x-input-label for="last_name" :value="__('Perekonnanimi')" />
                                    <x-text-input id="last_name" class="block mt-1 w-full" 
                                                    type="text" 
                                                    name="last_name" 
                                                    :value="old('last_name')" 
                                                    required autocomplete="last_name" />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <!-- Jersey number -->
                                <div class="mt-4">
                                    <x-input-label for="jersey_nr" :value="__('Särgi number')" />

                                    <x-text-input id="jersey_nr" class="block mt-1 w-full"
                                                    type="number"
                                                    name="jersey_nr"
                                                    required autocomplete="jersey_nr" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Position number -->
                                <div class="mt-4">
                                    <x-input-label for="pos_nr" :value="__('Postisioon')" />

                                    <x-text-input id="pos_nr" class="block mt-1 w-full"
                                                    type="number"
                                                    name="pos_nr" required autocomplete="pos_nr" />
                                    <x-input-error :messages="$errors->get('pos_nr')" class="mt-2" />
                                </div>

                                <!-- Birth date -->
                                <div class="mt-4">
                                    <x-input-label for="birth_date" :value="__('Sünniaeg')" />

                                    <x-text-input id="birth_date" class="block mt-1 w-full"
                                                    type="date"
                                                    name="birth_date" required autocomplete="birth_date" />
                                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                                </div>

                                <!-- Height -->
                                <div class="mt-4">
                                    <x-input-label for="height" :value="__('pikkus')" />

                                    <x-text-input id="height" class="block mt-1 w-full"
                                                    type="number"
                                                    name="height" required autocomplete="height" />
                                    <x-input-error :messages="$errors->get('height')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Registeeri') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <table class="relative w-full">
                        <thead class="bg-neutral-100 text-left">
                            <tr>
                                <th>Eesnimi</th>
                                <th>Perekonnanimi</th>
                                <th>Särgi number</th>
                                <th>Positsiooni number</th>
                                <th>Sünniaeg</th>
                                <th>Pikkus</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                        <tbody>
                            @foreach ($players as $player)
                            <tr class="border-b justify-between items-center text-left transition duration-300 ease-in-out hover:bg-neutral-100">   
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
                                    <a class="text-green-800" href="{{ route('players.edit', $player) }}">
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