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
    <body class="font-sans text-gray-400 antialiased">
    <main class="p-8 my-10 relative flex-column bg-black text-grey justify-center">
        <div class="bg-black relative w-full">
            <table class="w-full rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900/80 hover:bg-zinc-900/95 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
                <thead class="text-orange-600 text-center">
                    <tr>
                        <th>Tiim 1</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Tiim 2</th>
                        <th>Kuupäev</th>
                        <th>Kellaaeg</th>
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
                    <tr class="border-b justify-between text-orange-500 items-center text-center transition duration-300 ease-in-out hover:text-orange-600 hover:bg-gray-800">
                        <td>{{ $schedule->team1->team_name ?? 'Meeskonda ei leitud' }}</td>
                        <td>{{ $team1Points }}</td>
                        <td>:</td>
                        <td>{{ $team2Points }}</td>
                        <td>{{ $schedule->team2->team_name ?? 'Meeskonda ei leitud' }}</td>
                        <td>{{ date('d.m.Y', strtotime($schedule->date)) }}</td>
                        <td>{{ date('H:i', strtotime($schedule->time)) }}</td>
                        <td class="hidden lg:table-cell">{{ $schedule->venue }}</td>
                        <td class="hidden lg:table-cell">{{ $schedule->stages }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-footer></x-footer>
    </body>
</html>