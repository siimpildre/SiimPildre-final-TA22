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
    <body x-data="{ open: false }" class="bg-black">
        <header class="banner-container bg-banner-ball">
            <div class="min-h-screen flex flex-col items-center">
                <div class="w-full max-w-2xl px-6 lg:max-w-7xl">
                    <div class="grid grid-cols-2 justify-between pt-4 pb-10 lg:pb-10 lg:grid-cols-2">
                        <a href="./" class="flex items-center">
                            <h3 class="rounded-md px-3 py-2 text-white/90">
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
    <main class="my-10 relative bg-ball-basket flex-column bg-black text-white justify-items-center">
            <div class="bg-black w-full flex justify-center py-4">
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



    </body>
</html>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const link = document.querySelector('.spin-on-load');

    link.addEventListener('mouseenter', function() {
      this.style.animation = 'none'; 
      void this.offsetWidth;
      this.style.animation = 'spin-hover 1.5s ease-in-out 1'; 
    });
  });
</script>
