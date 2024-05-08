<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Saaremaa Korvpall</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            .banner-container {
                background-size: cover;
                background-position: center;
                width: 100vw;
                height: 320px;
            }

            .footer-img-container {
                width: 100vw; 
                height: auto; 
                background-size: cover; 
                background-position: center bottom; 
                min-height: 18rem;
            }

            .custom-heading {
                font-size: 40px;
                text-transform: uppercase;
                text-align: center;
            }
            .banner-container {
                height: 165px;
            }

            @media (min-width: 768px) {
                .custom-heading {
                    font-size: 54px;
                    text-transform: uppercase;
                    text-align: center;
                }
                .banner-container {
                    height: 180px;
                }
            }

            @media (min-width: 1024px) {
                .custom-heading {
                    font-size: 80px;
                    text-transform: uppercase;
                    text-align: center;
                }
                .banner-container {
                    height: 258px;
                }
            }

            @media (min-width: 1260px) {
                .custom-heading {
                    font-size: 110px;
                    text-transform: uppercase;
                    text-align: center;
                }
                .banner-container {
                    height: 290px;
                }
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

        @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                    <div class="flex mb-2 pt-12 sm:pt-12 md:pt-12 lg:pt-24 justify-center">
                        <h1 class="custom-heading text-white">
                            Saaremaa Korvpall
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="bg-ball-basket flex-column bg-black text-white justify-items-center">
            <div class="bg-black w-full flex justify-center pb-5 pt-10">
                @php
                    // Filter schedules to find the last game with statistics
                    $lastGameWithStats = $schedules->filter(function($schedule) {
                        return $schedule->statistics()->exists();
                    })->last();
                @endphp

                @if($lastGameWithStats)
                    @php
                        // Calculate total points for team 1
                        $team1Points = $lastGameWithStats->statistics()->where('team_id', $lastGameWithStats->team1_id)->sum('points');
                        
                        // Calculate total points for team 2
                        $team2Points = $lastGameWithStats->statistics()->where('team_id', $lastGameWithStats->team2_id)->sum('points');
                    @endphp

                    <div class=" w-auto bg-black">
                        <a href="/" class="text-relative flex justify-center rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900/80 hover:bg-zinc-900/95 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
                            <div class="pt-3 sm:pt-5 text-center">
                                <p class="pb-4 text-sm/relaxed">Viimane tulemus:</p>
                                <h2 class="text-4xl font-semibold">{{ $lastGameWithStats->team1->team_name }} vs {{ $lastGameWithStats->team2->team_name }}</h2>
                                <p class="mt-2 text-8xl">
                                    {{ $team1Points }} : {{ $team2Points }} 
                                </p>
                                <p class="mt-4 text-sm/relaxed">
                                    {{ date('d.m.Y', strtotime($lastGameWithStats->date)) }}
                                    <br>
                                    {{ $lastGameWithStats->stages }}
                                </p>
                            </div>
                        </a>
                    </div>
                @else
                    <p>Statistikat veel ei ole</p>
                @endif
            </div>
            <div class="bg-black text-center pb-5">
                <a href="{{ url('/tulemused') }}" class="inline-flex items-center px-4 py-2 border-2 border-transparent rounded-md font-semibold text-xs text-orange-500/75 uppercase tracking-widest hover:text-white hover:bg-orange-500/75 focus:bg-orange-700 active:bg-orange-900/75 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:text-white focus:ring-offset-2 transition ease-in-out duration-150">
                    Vaata rohkem
                </a>
            </div>


            <div class="bg-black relative bg-ball-basket footer-img-container flex justify-center">
                <div class="w-full max-w-2xl p-6 lg:max-w-7xl flex-column justify-center">
                    <h2 class="text-center mb-4 lg:text-4xl flex justify-center" style="text-transform: uppercase;">
                        Järgmised mängud:
                    </h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 md:gap-3 lg:grid-cols-4 lg:gap-8">
                        @php 
                            $upcomingGames = $schedules->filter(function($schedule) {
                                $dateTime = $schedule->date . ' ' . $schedule->time;
                                return strtotime($dateTime) > strtotime('now');
                            })->sortBy(function($schedule) {
                                return strtotime($schedule->date . ' ' . $schedule->time);
                            }); 
                        @endphp

                        @if ($upcomingGames->isEmpty())
                            <p class="mt-4 text-center text-lg/relaxed">Tulevasi mänge ei ole</p>
                        @else
                            @php $count = 0; @endphp
                            @foreach ($upcomingGames as $schedule)
                                @if ($count < 4)
                                    <a href="" class="text-relative flex justify-center rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900/80 hover:bg-zinc-900/90 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
                                        <div class="pt-3 sm:pt-5 text-center">
                                            <h2 class="text-xl font-semibold">{{ $schedule->team1->team_name }} vs {{ $schedule->team2->team_name }}</h2>
                                            <p class="mt2 text-lg">
                                                {{ date('H:i', strtotime($schedule->time))}}
                                            </p>
                                            <div class="mt-4 inline-block">
                                                <x-application-logo class="block h-9 w-auto fill-current text-gray-300" />
                                            </div>
                                            <p class="mt-4 text-sm/relaxed">
                                                {{ date('d.m.Y', strtotime($schedule->date)) }}
                                                <br>
                                                {{ $schedule->venue }}
                                                <br>
                                                {{ $schedule->stages }}
                                            </p>
                                        </div>
                                    </a>
                                    @php $count++; @endphp
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </main>
        <x-footer></x-footer>
    </body>
</html>