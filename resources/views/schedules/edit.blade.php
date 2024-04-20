<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{' Muuda mängu ajakava ja detaile' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('schedules.update', $schedule) }}">
                        @csrf
                        @method('patch')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="mt-4">
                            <x-input-label for="team1_id" :value="__('Meeskond 1')" />
                            <select id="team1_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                            name="team1_id" 
                                            :value="old('team1_id')" >

                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $schedule->team1_id == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('team1_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="team2_id" :value="__('Meeskond 2')" />
                            <select id="team2_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                            name="team2_id" 
                                            :value="old('team2_id')" >

                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $schedule->team2_id == $team->id ? 'selected' : '' }}>{{ $team->team_name }}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('team2_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="date" class="block text-gray-700">Kuupäev:</x-input-label>
                            <x-text-input type="date" format="d/m/Y'" name="date" id="date" class="block mt-1 w-full" :value="$schedule->date" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="time" class="block text-gray-700">Aeg:</x-input-label>
                            <x-text-input type="time" name="time" id="time" step="60" class="form-input mt-1 block w-full" :value="$schedule->time" />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="venue" class="block text-gray-700">Asukoht:</x-input-label>
                            <x-text-input type="text" name="venue" id="venue" class="form-input mt-1 block w-full"  :value="$schedule->venue"/>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="stages" value="Tüüp" />
                            <select id="stages" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                            name="stages" 
                                            :value="$schedule->stages" >
                                            
                                <option value="Põhiturniir" {{ old('stages', $schedule->stages) === 'Põhiturniir' ? 'selected' : '' }}>
                                    {{ __('Põhiturniir') }}
                                </option>
                                <option value="Vahegrupp" {{ old('stages', $schedule->stages) === 'Vahegrupp' ? 'selected' : '' }}>
                                    {{ __('Vahegrupp') }}
                                </option>
                                <option value="Playoff" {{ old('stages', $schedule->stages) === 'Playoff' ? 'selected' : '' }}>
                                    {{ __('Playoff') }}
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('stages')" class="mt-2" />
                        </div>

                        <div class="mt-4 space-x-2">
                            <x-primary-button>{{ __('Salvesta') }}</x-primary-button>
                            <a href="{{ route('schedules.index') }}">{{ __('Tühista') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>