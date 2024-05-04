<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
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
            .banner-container {
                background-size: cover;
                background-position: center;
                width: 100vw;
                height: 320px;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-black">
        <div class="bg-banner-ball banner-container bg-black-200">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <div>
                    <a href="./" class="spin-on-load inline-block" style="animation: spin 3s ease-in-out;">
                     <x-application-logo class="block w-20 h-20 fill-current text-gray-300" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
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

