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
            @media (max-width: 767px) {
                .sm\:custom-heading {
                    font-size: 40px;
                    text-transform: uppercase;
                }
            }
            @media (min-width: 768px) and (max-width: 1023px) {
                .md\:custom-heading {
                    font-size: 70px;
                    text-transform: uppercase;
                }
            }
            @media (min-width: 1024px) {
                .lg\:custom-heading {
                    font-size: 110px;
                    text-transform: uppercase;
                }
            }

            @layer utilities {
                @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg); /* Two full spins */
                }
                }

                @keyframes spin-hover {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg); /* One full spin */
                }
                }
            }
            
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-black text-white/50">
        <div class="bg-black text-white/90">
            <img id="background" class="absolute inset-0 w-auto h-full object-cover object-center lg:w-full lg:top-0 lg:left-0" src="{{ asset('pictures/banner_opacity.png') }}" alt="Basketball Banner" />
            <div class="relative min-h-screen flex flex-col items-center justify-center ">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="">
                        <div class="grid grid-cols-2 items-center justify-between gap-2 py-10 lg:grid-cols-2">
                            <div class="flex">
                                <h3 class="rounded-md px-3 py-2 text-white/90">
                                    Saare Spordiselts 
                                </h3>
                                <x-application-logo class="w-10 h-10 fill-white text-gray-500" />
                            </div>

                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    <a
                                        href="{{ url('/') }}"
                                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 "
                                    >
                                        Meeskonnad
                                    </a>
                                    <a
                                        href="{{ url('/') }}"
                                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 "
                                    >
                                        Tulemused
                                    </a>
                                    @auth
                                        <a
                                            href="{{ url('/dashboard') }}"
                                            class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 "
                                        >
                                            Töölaud
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('login') }}"
                                            class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 "
                                        >
                                            Logi sisse
                                        </a>

                                        @if (Route::has('register'))
                                            <a
                                                href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 "
                                        >
                                                Registreeri
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </div>
                        <div class="flex py-2 lg:py-10 justify-center">
                            <h1 class="lg:custom-heading sm:custom-heading md:custom-heading lg:custom-heading lg:py-2 text-white">
                                Saaremaa Korvpall
                            </h1>
                        </div>
                    </header>

                    <main class="absolute inset-x-0 top-full bg-black h-screen">
                    @php
                        // Filter schedules to find the last game with statistics
                        $lastGameWithStats = $schedules->filter(function($schedule) {
                            return $schedule->statistics()->exists();
                        })->last();
                    @endphp

                        @if($lastGameWithStats)
                            <div class=" bg-black">
                                <a href="https://laracasts.com" class="text-relative flex justify-center rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
                                    <div class="pt-3 sm:pt-5 text-center">
                                        <h2 class="text-xl font-semibold">{{ $lastGameWithStats->team1->team_name }} vs {{ $lastGameWithStats->team2->team_name }}</h2>
                                        <p class="mt2 text-lg">
                                        Total Score: 
                                        </p>
                                        <p class="mt-4 text-sm/relaxed">
                                            {{ date('d.m.Y', strtotime($lastGameWithStats->date)) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @else
                            <p>Statistikat veel ei ole</p>
                        @endif




                        <div class="max-h-[500px] overflow-y-auto relative">
                            <h2 class="text-center my-4 lg:text-4xl" style="text-transform: uppercase;">Järgmised mängud:</h2>
                            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 md:gap-7 lg:grid-cols-4 lg:gap-8">
                                <img id="background" class="absolute inset-0 w-auto h-full object-cover object-center lg:w-full lg:bottom-0 lg:left-0" src="{{ asset('pictures/balls_opacity.png') }}" alt="Basketballs in basket" />
                                @foreach ($schedules as $index => $schedule)
                                    <a href="https://laracasts.com" class="text-relative flex justify-center rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
                                        <div class="pt-3 sm:pt-5 text-center">
                                            <h2 class="text-xl font-semibold">{{ $schedule->team1->team_name }} vs {{ $schedule->team2->team_name }}</h2>
                                            <p class="mt2 text-lg">
                                                {{ date('H:i', strtotime($schedule->time))}}
                                            </p>
                                            <div class="mt-4 spin-on-load inline-block" style="animation: spin 3s ease-in-out 4;">
                                                <x-application-logo class="block h-9 w-auto fill-current text-gray-300" />
                                            </div>
                                            <p class="mt-4 text-sm/relaxed">
                                                {{ date('d.m.Y', strtotime($schedule->date)) }}
                                                <br>
                                                {{ $schedule->venue }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                    </div>
                        
                    </main>

                    <footer class="lg:py-16 text-center text-sm text-black dark:text-white/70">
                        <a href="https://www.facebook.com/saarespordiselts">Saare Spordiselts MTÜ</a>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const link = document.querySelector('.spin-on-load');
  });
</script>


