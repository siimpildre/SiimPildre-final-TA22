<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajakava') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="mb-8">
                        <form method="POST" action="{{ route('schedules.store') }}">
                            @csrf
                            <h2 class="font-semibold mt-6 text-xl text-gray-800 leading-tight">
                                {{ __('Lisa uus mäng') }}
                            </h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="mt-4">
                                    <x-input-label for="team1_id" :value="__('Meeskond 1')" />
                                    <select id="team1_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                                    name="team1_id" 
                                                    :value="old('team1_id')">

                                        <option value="">{{ __('Vali meeskond 1') }}</option>
                                        @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('team1_id')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="team2_id" :value="__('Meeskond 2')" />
                                    <select id="team2_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                                    name="team2_id" 
                                                    :value="old('team2_id')" >

                                        <option value="">Vali meeskond 2</option>
                                        @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('team2_id')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="date" class="block text-gray-700">Kuupäev:</x-input-label>
                                    <x-text-input type="date" format="d/m/Y'" name="date" id="date" class="block mt-1 w-full" :value="old('date')"/>
                                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="time" class="block text-gray-700">Aeg:</x-input-label>
                                    <x-text-input type="time" name="time" id="time" step="60" class="form-input mt-1 block w-full"  :value="old('time')"/>
                                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="venue" class="block text-gray-700">Asukoht:</x-input-label>
                                    <x-text-input type="text" name="venue" id="venue" class="form-input mt-1 block w-full" :value="old('venue')"/>
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="stages" value="Tüüp" />
                                    <select id="stages" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                            name="stages" 
                                            :value="old('stages')">
                                        <option value="Põhiturniir">{{ __('Põhiturniir') }}</option>
                                        <option value="Vahegrupp">{{ __('Vahegrupp') }}</option>
                                        <option value="Playoff">{{ __('Playoff') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">{{ __('Avalda mäng') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                    <table class="relative w-full">
                        <thead class="bg-neutral-100 text-left">
                            <tr>
                                <th>Meeskond 1</th>
                                <th>Meeskond 2</th>
                                <th>Kuupäev</th>
                                <th class="hidden lg:table-cell">Kellaaeg</th>
                                <th class="hidden lg:table-cell">Asukoht</th>
                                <th class="hidden lg:table-cell">Tüüp</th>
                                <th ></th>
                                <th class="hidden lg:table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                            <tr class="border-b justify-between items-center text-left transition duration-300 ease-in-out hover:bg-neutral-100">
                                <td>{{ $schedule->team1->team_name ?? 'Meeskonda ei leitud' }}</td>
                                <td>{{ $schedule->team2->team_name ?? 'Meeskonda ei leitud' }}</td>
                                <td>{{ date('d.m.Y', strtotime($schedule->date)) }}</td>
                                <td class="hidden lg:table-cell">{{ date('H:i', strtotime($schedule->time)) }}</td>
                                <td class="hidden lg:table-cell">{{ $schedule->venue }}</td>
                                <td class="hidden lg:table-cell">{{ $schedule->stages }}</td>
                                <td>
                                    <a class="text-green-800" href="{{ route('schedules.edit', $schedule) }}">
                                        {{ __('Muuda') }}
                                    </a>
                                </td>
                                <td class="hidden lg:table-cell">
                                    <form method="POST" action="{{ route('schedules.destroy', $schedule) }}">

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
                        {{ $schedules->links() }}
                    </div>
                </div>
             </div>
        </div>
    </div>


</x-app-layout>