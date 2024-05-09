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
                            404
                        </h1>
                    </div>
                </div>
            </div>
        </header>
    <body class="font-sans text-gray-400 antialiased">
    <main class="p-8 my-10 flex-column bg-black text-grey justify-center">
        <div class="w-full flex justify-center items-center h-full">
            <div class="flex flex-col p items-center">
                <h1 class="custom-heading text-center sm:text-xl md:text-2xl lg:text-3xl lg:py-2 text-white">
                    Leht on ehitamisel
                </h1>
                <div class="spin-on-load p-4 my-8 inline-block" style="animation: spin 3s ease-in-out;">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                </div>
            </div>
        </div>

        <footer class="lg:py-10 text-center text-sm text-black dark:text-white/70">
            <a href="https://www.facebook.com/saarespordiselts" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90">
                Saare Spordiselts MTÜ
            </a>
            <p class="text-white text-sm">
                saarespordiselts@gmail.com
            </p>   
        </footer>


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
