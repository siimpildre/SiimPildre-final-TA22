<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ 'Statistika: ' . $schedule->team1->team_name  . ' vs ' . $schedule->team2->team_name  . ' ' . date('d.m.Y', strtotime($schedule->date)) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="mb-8">
                    <form method="POST" action="{{ route('statistics.store') }}">
                        @csrf

                        <table class="w-auto">
                            <thead>
                                <tr>

                                    <th><x-input-label for="name" :value="__('Mängija')" /></th>
                                    <th><x-input-label for="game_jersey_nr" :value="__('Särgi nr.')" /></th>
                                    <th><x-input-label for="played" :value="__('Minutid')" /></th>
                                    <th><x-input-label for="3-p" :value="__('3-P')" /></th>
                                    <th><x-input-label for="free-t" :value="__('VV-V')" /></th>
                                    <th><x-input-label for="free-m" :value="__('VV-S')" /></th>
                                    <th><x-input-label for="fouls" :value="__('Vead')" /></th>
                                    <th><x-input-label for="techincals" :value="__('Teh.')" /></th>
                                    <th><x-input-label for="unsportsman" :value="__('Ebas.')" /></th>
                                    <th><x-input-label for="points" :value="__('Punktid')" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($team1Players as $player)
                        
                                <input type="hidden" name="statistics[{{ $player->id }}][schedule_id]" value="{{ $schedule->id }}">
                                <input-error :messages="$errors->get('schedule_id')" class="mt-2" />
                            
                                <input type="hidden" name="statistics[{{ $player->id }}][team_id]" value="{{ $schedule->team1_id }}">
                                <input-error :messages="$errors->get('team_id')" class="mt-2" />
                            
                                <input type="hidden" name="statistics[{{ $player->id }}][player_id]" value="{{ $player->id }}">
                                <input-error :messages="$errors->get('player_id')" class="mt-2" />
                                    
                                <tr>
                                    <td>{{ $player->first_name . ' ' . $player->last_name }}</td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][game_jersey_nr]" class="form-input w-20" :value="old('game_jersey_nr')">
                                        <input-error :messages="$errors->get('game_jersey_nr')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][played]" class="form-input w-20" :value="old('played')">
                                        <input-error :messages="$errors->get('played')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][3-p]" class="form-input w-20" :value="old('3-p')">
                                        <input-error :messages="$errors->get('3-p')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][free_t]" class="form-input w-20" :value="old('free_t')">
                                        <input-error :messages="$errors->get('free_t')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][free_m]" class="form-input w-20" :value="old('free_m')">
                                        <input-error :messages="$errors->get('free_m')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][fouls]" class="form-input w-20" :value="old('fouls')">
                                        <input-error :messages="$errors->get('fouls')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][techincals]" class="form-input w-20" :value="old('techincals')">
                                        <input-error :messages="$errors->get('techincals')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][unsportsman]" class="form-input w-20" :value="old('unsportsman')">
                                        <input-error :messages="$errors->get('unsportsman')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][points]" class="form-input w-20" :value="old('points')">
                                        <input-error :messages="$errors->get('points')" class="mt-2" />
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="w-auto">
                            <thead>
                                <tr>
                                    <th><x-input-label for="name" :value="__('Mängija')" /></th>
                                    <th><x-input-label for="game_jersey_nr" :value="__('Särgi nr.')" /></th>
                                    <th><x-input-label for="played" :value="__('Minutid')" /></th>
                                    <th><x-input-label for="3-p" :value="__('3-P')" /></th>
                                    <th><x-input-label for="free-t" :value="__('VV-V')" /></th>
                                    <th><x-input-label for="free-m" :value="__('VV-S')" /></th>
                                    <th><x-input-label for="fouls" :value="__('Vead')" /></th>
                                    <th><x-input-label for="techincals" :value="__('Teh.')" /></th>
                                    <th><x-input-label for="unsportsman" :value="__('Ebas.')" /></th>
                                    <th><x-input-label for="points" :value="__('Punktid')" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($team2Players as $player)
                        
                                <input type="hidden" name="statistics[{{ $player->id }}][schedule_id]" value="{{ $schedule->id }}">
                                <input-error :messages="$errors->get('schedule_id')" class="mt-2" />
                            
                                <input type="hidden" name="statistics[{{ $player->id }}][team_id]" value="{{ $schedule->team1_id }}">
                                <input-error :messages="$errors->get('team_id')" class="mt-2" />
                            
                                <input type="hidden" name="statistics[{{ $player->id }}][player_id]" value="{{ $player->id }}">
                                <input-error :messages="$errors->get('player_id')" class="mt-2" />
                                    
                                <tr>
                                    <td>{{ $player->first_name . ' ' . $player->last_name }}</td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][game_jersey_nr]" class="form-input w-20" :value="old('game_jersey_nr')">
                                        <input-error :messages="$errors->get('game_jersey_nr')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][played]" class="form-input w-20" :value="old('played')">
                                        <input-error :messages="$errors->get('played')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][3-p]" class="form-input w-20" :value="old('3-p')">
                                        <input-error :messages="$errors->get('3-p')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][free_t]" class="form-input w-20" :value="old('free_t')">
                                        <input-error :messages="$errors->get('free_t')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][free_m]" class="form-input w-20" :value="old('free_m')">
                                        <input-error :messages="$errors->get('free_m')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][fouls]" class="form-input w-20" :value="old('fouls')">
                                        <input-error :messages="$errors->get('fouls')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][techincals]" class="form-input w-20" :value="old('techincals')">
                                        <input-error :messages="$errors->get('techincals')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][unsportsman]" class="form-input w-20" :value="old('unsportsman')">
                                        <input-error :messages="$errors->get('unsportsman')" class="mt-2" />
                                    </td>
                                    <td>
                                        <input type="text" name="statistics[{{ $player->id }}][points]" class="form-input w-20" :value="old('points')">
                                        <input-error :messages="$errors->get('points')" class="mt-2" />
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <x-primary-button type="submit">Salvesta</x-primary-button>
                        </div>
                    </form>

                </div>
             </div>
        </div>
    </div>


</x-app-layout>