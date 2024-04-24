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
                height: 340px;
            }
            .footer-img-container {
                width: 100vw; 
                height: auto; /* Default height for small screens */
                background-size: cover; 
                background-position: center bottom; 
            }

            @media (min-width: 768px) {
                .banner-container {
                    height: 350px; /* Adjust height for medium screens */
                }
            }

            @media (min-width: 1024px) {
                .banner-container {
                    height: 500px; /* Limit maximum height for large screens */
                }
            }

            @media (max-width: 767px) {
                .sm\:custom-heading {
                    font-size: 40px;
                    text-transform: uppercase;
                    text-align: center;
                }
                .sm\:custom-heading {
                    
                }
            }
            @media (min-width: 768px) {
                .md\:custom-heading {
                    font-size: 50px;
                    text-transform: uppercase;
                    text-align: center;
                }
            }

            @media (min-width: 1024px) {
                .lg\:custom-heading {
                    font-size: 80px;
                    text-transform: uppercase;
                    text-align: center;
                }
            }
            @media (min-width: 1260px) {
                .lg\:custom-heading {
                    font-size: 110px;
                    text-transform: uppercase;
                    text-align: center;
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
                <div class="w-full max-w-2xl px-6 lg:max-w-7xl">
                    <div class="grid grid-cols-2 justify-between pt-4 pb-10 lg:pb-10 lg:grid-cols-2">
                        <div class="flex items-center">
                            <h3 class="rounded-md px-3 py-2 text-white/90">
                                Saare Spordiselts 
                            </h3>
                            <a href="./" class="spin-on-load inline-block" style="animation: spin 3s ease-in-out;">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                            </a>
                        </div>

                        <x-guest-hamburger/>

                    </div>
                    <div class="flex pb-2 pt-44 lg:pt-64 justify-center">
                        <h1 class="lg:custom-heading sm:custom-heading md:custom-heading lg:custom-heading lg:py-2 text-white">
                            Saaremaa Korvpall
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="my-10 relative bg-ball-basket flex-column bg-black text-white justify-items-center">
            <div class="bg-black w-full flex justify-center py-4">

                @php
                    // Filter schedules to find the last game with statistics
                    $lastGameWithStats = $schedules->filter(function($schedule) {
                        return $schedule->statistics()->exists();
                    })->last();
                @endphp

                @if($lastGameWithStats)
                    <div class=" w-auto bg-black">
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
            </div>
            <div class="bg-black text-center pb-10">
                <x-primary-button href="{{ url('/') }}" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 ">Vaata rohkem</x-primary-button>
            </div>



            <div class="bg-black">
                <div class="relative bg-ball-basket footer-img-container flex justify-center">
                    <div class="w-full max-w-2xl p-6 lg:max-w-7xl flex-column justify-center">
                        <h2 class="text-center mb-4 lg:text-4xl flex justify-center" style="text-transform: uppercase;">
                            Järgmised mängud:
                        </h2>
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 md:gap-3 lg:grid-cols-4 lg:gap-8">
                            @foreach ($schedules as $index => $schedule)
                                <a href="" class="text-relative flex justify-center rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-orange-500 hover:ring-zinc-700 focus-visible:ring-orange-500 spin-on-load">
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
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="relative lg:py-10 text-center text-sm text-black dark:text-white/70">
            <a href="https://www.facebook.com/saarespordiselts" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90">
                Saare Spordiselts MTÜ
            </a>
        </footer>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                const mobileMenu = document.getElementById('mobile-menu');

                mobileMenuToggle.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            });
        </script>
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
