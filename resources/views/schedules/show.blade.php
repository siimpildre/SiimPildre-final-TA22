@if (Route::has('login'))
    @auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $team1_name  . ' vs ' . $team2_name }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-600 leading-tight"> 
                {{ date('d.m.Y', strtotime($schedule->date)) }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                            <div class="mt-4 space-x-2">
                                <a href="{{ route('schedules.index') }}">{{ __('Tagasi') }}</a>
                            </div>
                        </ul>
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
                                {{ $team1_name  . ' vs ' . $team2_name }}
                                <br>
                                {{ date('d.m.Y', strtotime($schedule->date)) }}
                            </h1>
                        </div>
                    </div>
                </div>
            </header>
            <main class="p-8 my-10 bg-black text-gray-900">
                <div class="mb-10 w-full p rounded-lg p-6 lg:p-12  ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none bg-zinc-100/90 ring-zinc-800 hover:ring-zinc-700 focus-visible:ring-orange-500">
                    <div class="text-orange-900 grid grid-cols-2 p-6 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-4 max-w-7xl">
                    {{ date('d.m.Y', strtotime($schedule->date)) }}
                    
                    <div>
                        <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                        <h2 class="text-lg font-semibold text-orange-600 mb-4">Statistika</h2>
                        
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