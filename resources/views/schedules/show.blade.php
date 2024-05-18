<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Saaremaa Korvpall') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .banner-container {
                background-size: cover;
                background-position: center;
                width: 100vw;
                height: 150px;
            }
            .custom-heading {
                text-transform: uppercase;
            }

            @layer utilities {
                @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg); 
                }
                }

                @keyframes spin-hover {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg); 
                }
                }
                
                .shadow-top-black {
                    box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1),
                                0 -6px 16px 0 rgba(0, 0, 0, 0.06);
                }
            }
            
        </style>
    </head>
    <body class="bg-black">
        <header class="banner-container bg-black bg-banner-ball">
            <div class="min-h-screen flex flex-col items-center">
                <div class="w-full max-w-2xl px-6 md:max-w-4xl lg:max-w-7xl">
                    <div class="flex justify-between pt-4 pb-4">
                        <a href="./" class="flex items-center">
                            <h3 class="logo rounded-md px-3 py-2 text-white/90">
                                Saare Spordiselts 
                            </h3>
                            <div class="spin-on-load inline-block" style="animation: spin 3s ease-in-out;">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                            </div>
                        </a>

                        <x-guest-hamburger/>

                    </div>
                    <div class="flex pt-4 lg:pt-4 justify-start">
                        <h1 class="custom-heading sm:text-xl md:text-2xl lg:text-3xl lg:py-2 text-white">
                            {{ $team1_name  . ' vs ' . $team2_name }}
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="p-8 my-10 bg-black text-gray-900">
            <div class="mb-10 w-full p rounded-lg p-6 lg:p-12  ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none bg-zinc-100/90 ring-zinc-800 hover:ring-zinc-700 focus-visible:ring-orange-500">
                <div class="text-orange-900 grid grid-cols-2 p-6 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-4 max-w-7xl">
                    <div>
                        <x-input-label for="title" value="Kuupäev" />
                        {{ date('d.m.Y', strtotime($schedule->date)) }}
                    </div>
                    <div>
                        <x-input-label for="title" value="Aeg" />
                        {{ date('H:i', strtotime($schedule->time)) }}
                    </div>
                    <div>
                        <x-input-label for="title" value="Asukoht" />
                        {{ $schedule->venue }}
                    </div>
                </div>
                <div>
                    <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                        <h2 class="text-lg font-semibold text-orange-600 mb-4">
                        {{ $team1_name }}
                        </h2>
                        <table class="w-full">
                            <thead>
                                <tr class="text-orange-600">
                                    <th class="text-left">Nimi</th>
                                    <th>Särgi nr</th>
                                    <th>Minutid</th>
                                    <th>3-p</th>
                                    <th>Vabav.</th>
                                    <th>Vead</th>
                                    <th>Tehnilised</th>
                                    <th>Ebasportlikud</th>
                                    <th>Punktid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total3P = $totalFreeT = $totalFreeM = $totalFouls = $totalTechnicals = $totalUnsportsman = $totalPoints = 0;
                                @endphp
                                @foreach ($statisticsTeam1 as $stat)
                                    <tr onclick="window.location='{{ route('players.show', $stat->player_id) }}';" style="cursor:pointer;" class="border-t text-zinc-900 items-center text-center transition duration-300 ease-in-out hover:text-orange-500 hover:bg-gray-200">
                                        <td class="text-left">{{ $stat->player->first_name . ' ' . $stat->player->last_name }}</td>
                                        <td>{{ $stat->game_jersey_nr }}</td>
                                        <td>{{ $stat->played }}</td>
                                        <td>{{ $stat->{'3-p'} }}</td>
                                        <td>{{ $stat->free_t }}/{{ $stat->free_m }}</td>
                                        <td>{{ $stat->fouls }}</td>
                                        <td>{{ $stat->techincals }}</td>
                                        <td>{{ $stat->unsportsman }}</td>
                                        <td>{{ $stat->points }}</td>
                                    </tr>
                                    @php
                                        $total3P += $stat->{'3-p'};
                                        $totalFouls += $stat->fouls;
                                        $totalTechnicals += $stat->techincals;
                                        $totalUnsportsman += $stat->unsportsman;
                                        $totalPoints += $stat->points;
                                        $totalFreeT += $stat->free_t;
                                        $totalFreeM += $stat->free_m;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-200 text-orange-900 text-center align-top font-semibold">
                                    <td class="text-left">Kokku</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $total3P }}</td>
                                    <td>
                                        {{ $totalFreeT }}/{{ $totalFreeM }}
                                        <br>
                                        {{ number_format(($totalFreeM / $totalFreeT) * 100) }}%
                                    </td>
                                    <td>{{ $totalFouls }}</td>
                                    <td>{{ $totalTechnicals }}</td>
                                    <td>{{ $totalUnsportsman }}</td>
                                    <td>{{ $totalPoints }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="p-6 mt-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                        <h2 class="text-lg font-semibold text-orange-600 mb-4">
                        {{ $team2_name }}
                        </h2>
                        <table class="w-full">
                            <thead>
                                <tr class="text-orange-600">
                                    <th class="text-left">Nimi</th>
                                    <th>Särgi nr</th>
                                    <th>Minutid</th>
                                    <th>3-p</th>
                                    <th>Vabav.</th>
                                    <th>Vead</th>
                                    <th>Tehnilised</th>
                                    <th>Ebasportlikud</th>
                                    <th>Punktid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total3P = $totalFreeT = $totalFreeM = $totalFouls = $totalTechnicals = $totalUnsportsman = $totalPoints = 0;
                                @endphp
                                @foreach ($statisticsTeam2 as $stat)
                                    <tr onclick="window.location='{{ route('players.show', $stat->player_id) }}';" style="cursor:pointer;" class="border-t text-zinc-900 items-center text-center transition duration-300 ease-in-out hover:text-orange-500 hover:bg-gray-200">
                                        <td class="text-left">{{ $stat->player->first_name . ' ' . $stat->player->last_name }}</td>
                                        <td>{{ $stat->game_jersey_nr }}</td>
                                        <td>{{ $stat->played }}</td>
                                        <td>{{ $stat->{'3-p'} }}</td>
                                        <td>{{ $stat->free_t }}/{{ $stat->free_m }}</td>
                                        <td>{{ $stat->fouls }}</td>
                                        <td>{{ $stat->techincals }}</td>
                                        <td>{{ $stat->unsportsman }}</td>
                                        <td>{{ $stat->points }}</td>
                                    </tr>
                                    @php
                                        $total3P += $stat->{'3-p'};
                                        $totalFouls += $stat->fouls;
                                        $totalTechnicals += $stat->techincals;
                                        $totalUnsportsman += $stat->unsportsman;
                                        $totalPoints += $stat->points;
                                        $totalFreeT += $stat->free_t;
                                        $totalFreeM += $stat->free_m;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-200 text-center text-orange-900 align-top font-semibold">
                                    <td class="text-left">Kokku</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $total3P }}</td>
                                    <td>
                                        {{ $totalFreeT }}/{{ $totalFreeM }}
                                        <br>
                                        {{ number_format(($totalFreeM / $totalFreeT) * 100) }}%
                                    </td>
                                    <td>{{ $totalFouls }}</td>
                                    <td>{{ $totalTechnicals }}</td>
                                    <td>{{ $totalUnsportsman }}</td>
                                    <td>{{ $totalPoints }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="pt-6 lg:pt-12 space-x-2">
                    <a class="hover:text-orange-500" href="{{ url()->previous() }}">
                        {{ __('Tagasi') }}
                    </a>
                </div>
            </div>
        </main> 
        <x-footer></x-footer>
    </body>
</html>
