@if (Route::has('login'))
    @auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $player->first_name . ' ' . $player->last_name }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-600 leading-tight"> 
                @if ($player->teams->count() > 0)
                @foreach ($player->teams as $team)
                    {{ $team->team_name }}
                @endforeach
                @else
                    <p class="text-rose-700">Vaba mängija</p>
                @endif
            </h2>

        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-6">
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
                            {{ old('title', date('d.m.Y', strtotime($player->birth_date))) }}
                            </li>
                            <li>
                            <x-input-label for="title" value="Pikkus" />
                            {{ old('title', $player->height) }}
                            </li>
                        </ul>
                        <div class="p-6 mb-6 mt-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 focus-visible:ring-orange-500">
                            <h2 class="text-lg font-semibold text-orange-600 mb-4">Mängija keskmised</h2>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-6">
                                <li>
                                    <span class="font-semibold">Punktid:</span> {{ number_format($averagePoints, 2) }}
                                </li>
                                <li>
                                    <span class="font-semibold">Kolmesed:</span> {{ number_format($averageThreeP, 2) }}
                                </li>
                                <li>
                                    <span class="font-semibold">Vead:</span> {{ number_format($averageFouls, 2) }}
                                </li>
                                <li>
                                    <span class="font-semibold">Tehnilised:</span> {{ number_format($averageTech, 2) }}
                                </li>
                                <li>
                                    <span class="font-semibold">Ebasportlikud:</span> {{ number_format($averageUnspo, 2) }}
                                </li>
                                <li>
                                    <span class="font-semibold">Vabavisked:</span> {{ number_format($freeThrowPercentage, 2) }}%
                                </li>
                                <li>
                                    <span class="font-semibold">Mängud:</span> {{ $gamesPlayed }}
                                </li>
                            </ul>
                        </div>
                        <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                            <h2 class="text-lg font-semibold text-orange-600 mb-4">
                                Statistika
                            </h2>
                            <table class="w-full">
                                <thead>
                                    <tr class="text-orange-600">
                                        <th>Vastane</th>
                                        <th>Särgi nr</th>
                                        <th>Minutid</th>
                                        <th>3-p</th>
                                        <th>vv-v</th>
                                        <th>vv-s</th>
                                        <th>Vead</th>
                                        <th>Tehnilised</th>
                                        <th>Ebasportlikud</th>
                                        <th>Punktid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statistics as $stat)
                                        <tr class="border-t justify-between text-zinc-900 items-center transition duration-300 ease-in-out text-center hover:text-orange-500 hover:bg-gray-200">
                                            <td>
                                                @if ($stat->schedule->team1_id != $stat->team_id)
                                                    {{ $stat->schedule->team1->team_name }}
                                                @else
                                                    {{ $stat->schedule->team2->team_name }}
                                                @endif
                                            </td>
                                            <td>{{ $stat->game_jersey_nr }}</td>
                                            <td>{{ $stat->played }}</td>
                                            <td>{{ $stat->{'3-p'} }}</td>
                                            <td>{{ $stat->free_t }}</td>
                                            <td>{{ $stat->free_m }}</td>
                                            <td>{{ $stat->fouls }}</td>
                                            <td>{{ $stat->techincals }}</td>
                                            <td>{{ $stat->unsportsman }}</td>
                                            <td>{{ $stat->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 space-x-2">
                            <a href="{{ route('players.index') }}">{{ __('Tagasi') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    @else
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
                                {{ $player->first_name . ' ' . $player->last_name }}
                            </h1>
                        </div>
                    </div>
                </div>
            </header>
            <main class="p-8 my-10 bg-black text-gray-900">
                <div class="mb-10 w-full p rounded-lg p-6 lg:p-12  ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none bg-zinc-100/90 ring-zinc-800 hover:ring-zinc-700 focus-visible:ring-orange-500">
                    <div class="text-orange-900 grid grid-cols-2 p-6 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-4 max-w-7xl">
                        <div>
                            <x-input-label for="title" value="Meeskond" />
                                @if ($player->teams->count() > 0)
                                    @foreach ($player->teams as $team)
                                        {{ $team->team_name }}
                                    @endforeach
                                    @else
                                        <p class="text-rose-700">Vaba mängija</p>
                                @endif
                        </div>
                        <div>
                            <x-input-label for="title" value="Särgi number" />
                            {{ old('title', $player->jersey_nr) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Positsioon" />
                            {{ old('title', $player->pos_nr) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Sünniaeg" />
                            {{ old('title', date('d.m.Y', strtotime($player->birth_date))) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Pikkus" />
                            {{ old('title', $player->height) }}
                        </div>
                    </div>
                    <div class="p-6 mb-6 mt-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 focus-visible:ring-orange-500">
                        <h2 class="text-lg font-semibold text-orange-600 mb-4">Mängija keskmised</h2>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-6">
                            <li>
                                <span class="font-semibold">Punktid:</span> {{ number_format($averagePoints, 2) }}
                            </li>
                            <li>
                                <span class="font-semibold">Kolmesed:</span> {{ number_format($averageThreeP, 2) }}
                            </li>
                            <li>
                                <span class="font-semibold">Vead:</span> {{ number_format($averageFouls, 2) }}
                            </li>
                            <li>
                                <span class="font-semibold">Tehnilised:</span> {{ number_format($averageTech, 2) }}
                            </li>
                            <li>
                                <span class="font-semibold">Ebasportlikud:</span> {{ number_format($averageUnspo, 2) }}
                            </li>
                            <li>
                                <span class="font-semibold">Vabavisked:</span> {{ number_format($freeThrowPercentage, 2) }}%
                            </li>
                            <li>
                                <span class="font-semibold">Mängud:</span> {{ $gamesPlayed }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                            <h2 class="text-lg font-semibold text-orange-600 mb-4">Statistika</h2>
                            <table class="w-full">
                                <thead>
                                    <tr class="text-orange-600">
                                        <th class="text-left">Vastane</th>
                                        <th>Särgi nr</th>
                                        <th>Minutid</th>
                                        <th>3-p</th>
                                        <th>vv-v</th>
                                        <th>vv-s</th>
                                        <th>Vead</th>
                                        <th>Tehnilised</th>
                                        <th>Ebasportlikud</th>
                                        <th>Punktid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statistics as $stat)
                                        <tr onclick="window.location='{{ route('schedules.show', $stat->schedule_id) }}';" style="cursor:pointer;" class="border-t justify-between text-zinc-900 items-center transition duration-300 ease-in-out text-center hover:text-orange-500 hover:bg-gray-200">
                                            <td class="text-left">
                                                @if ($stat->schedule->team1_id != $stat->team_id)
                                                    {{ $stat->schedule->team1->team_name }}
                                                @else
                                                    {{ $stat->schedule->team2->team_name }}
                                                @endif
                                            </td>
                                            <td>{{ $stat->game_jersey_nr }}</td>
                                            <td>{{ $stat->played }}</td>
                                            <td>{{ $stat->{'3-p'} }}</td>
                                            <td>{{ $stat->free_t }}</td>
                                            <td>{{ $stat->free_m }}</td>
                                            <td>{{ $stat->fouls }}</td>
                                            <td>{{ $stat->techincals }}</td>
                                            <td>{{ $stat->unsportsman }}</td>
                                            <td>{{ $stat->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
    @endauth
@endif