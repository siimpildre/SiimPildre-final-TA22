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
            }
            
        </style>
    </head>
    <body class="bg-black">
        <header class="banner-container bg-banner-ball">
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
                            Tulemused
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="p-8 my-10 bg-black text-gray-900">
            <div class="mb-10 w-full p rounded-lg p-6 lg:p-12 ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none bg-zinc-100/90 ring-zinc-800 hover:ring-zinc-700 focus-visible:ring-orange-500">
                <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                    <table class="w-full">
                        <thead class="text-orange-600">
                            <tr>
                                <th>Kodus</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Võõrsil</th>
                                <th class="hidden md:table-cell lg:table-cell">Kuupäev</th>
                                <th class="hidden sm:table-cell md:table-cell lg:table-cell">Kellaaeg</th>
                                <th class="hidden lg:table-cell">Asukoht</th>
                                <th class="hidden lg:table-cell">Tüüp</th>
                                <th ></th>
                                <th class="hidden lg:table-cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                            @php
                                $team1Points = $schedule->statistics()->where('team_id', $schedule->team1_id)->sum('points');
                                $team2Points = $schedule->statistics()->where('team_id', $schedule->team2_id)->sum('points');
                            @endphp
                            <tr onclick="window.location='{{ route('schedules.show', $schedule->id) }}';" style="cursor:pointer;" class="border-t justify-between text-zinc-900 items-center transition duration-300 ease-in-out text-center hover:text-orange-500 hover:bg-gray-200">
                                <td>{{ $schedule->team1->team_name ?? 'Meeskonda ei leitud' }}</td>
                                <td>{{ $team1Points > 0 ? $team1Points : '' }}</td>
                                <td>:</td>
                                <td>{{ $team2Points > 0 ? $team2Points : '' }}</td>
                                <td>{{ $schedule->team2->team_name ?? 'Meeskonda ei leitud' }}</td>
                                <td class="hidden md:table-cell lg:table-cell">{{ date('d.m.Y', strtotime($schedule->date)) }}</td>
                                <td class="hidden sm:table-cell md:table-cell lg:table-cell">{{ date('H:i', strtotime($schedule->time)) }}</td>
                                <td class="hidden lg:table-cell">{{ $schedule->venue }}</td>
                                <td class="hidden lg:table-cell">{{ $schedule->stages }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </div>
                    </table>
                </div>
                <div class="pt-6 space-x-2 lg:pt-12">
                    <a class="hover:text-orange-500" href="{{ route('welcome') }}">{{ __('Tagasi') }}</a>
                </div>
            </div>
        </main> 
        <x-footer></x-footer>
    </body>
</html>