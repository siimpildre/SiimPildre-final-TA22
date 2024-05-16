@if (Route::has('login'))
    @auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $team->team_name }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-gray-900 grid grid-cols-1 pt-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div>
                            <x-input-label for="title" value="Meeskonnanimi" />
                            {{ old('title', $team->team_name ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Lühend" />
                            {{ old('title', $team->short_name ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Treener" />
                            {{ old('title', $team->coach ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Kontakt number" />
                            {{ old('title', $team->contact_nr ) }}
                        </div>
                    </div>
                    <div class="py-6 px-8">

                            <div class="mt-4 space-x-2">
                                <a href="{{ route('teams.index') }}">{{ __('Tagasi') }}</a>
                            </div>
                        
                    </div>
                    <div>
                        <div class="p-6 text-gray-900">
                            <table class="relative w-full">
                                <thead class="bg-neutral-100 text-left">
                                    <tr>
                                        <th>Eesnimi</th>
                                        <th>Perekonnanimi</th>
                                        <th>Särgi number</th>
                                        <th>Positsiooni number</th>
                                        <th>Sünniaeg</th>
                                        <th>Pikkus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
                                {{ $team->team_name }}
                            </h1>
                        </div>
                    </div>
                </div>
            </header>
            <main class="p-8 my-10 bg-black text-gray-900">
                <div class="mb-10 w-full p rounded-lg p-6 lg:p-12  ring-1 ring-white/[0.05] transition duration-300 hover:ring-black/20 focus:outline-none bg-zinc-100/90 ring-zinc-800 hover:ring-zinc-700 focus-visible:ring-orange-500">
                    <div class="text-orange-900 grid grid-cols-1 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-7xl">
                        <div>
                            <x-input-label for="title" value="Meeskonnanimi" />
                            {{ old('title', $team->team_name ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Lühend" />
                            {{ old('title', $team->short_name ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Treener" />
                            {{ old('title', $team->coach ) }}
                        </div>
                        <div>
                            <x-input-label for="title" value="Kontakt number" />
                            {{ old('title', $team->contact_nr ) }}
                        </div>
                    </div>
                    <div>
                        <div class="p-6 shadow-lg rounded-lg transition duration-300 focus:outline-none bg-zinc-100/80 hover:bg-zinc-100/95 hover:text-orange-500 focus-visible:ring-orange-500">
                            <table class="w-full s">
                                <thead class="text-orange-600 text-center">
                                    <tr>
                                        <th>Eesnimi</th>
                                        <th>Perekonnanimi</th>
                                        <th>Särgi number</th>
                                        <th>Positsiooni number</th>
                                        <th>Sünniaeg</th>
                                        <th>Pikkus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($players as $player)
                                    <tr onclick="window.location='{{ route('players.show', $player->id) }}';" style="cursor:pointer;" class="border-t justify-between text-zinc-900 items-center transition duration-300 ease-in-out text-center hover:text-orange-500 hover:bg-gray-200">
                                        <td>
                                            {{ $player->first_name }} 
                                        </td>
                                        <td>
                                            {{ $player->last_name }}
                                        </td>
                                        <td>
                                            {{ $player->jersey_nr }}
                                        </td>
                                        <td>
                                            {{ $player->pos_nr }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($player->birth_date)->format('d.m.Y') }}
                                        </td>
                                        <td>
                                            {{ $player->height }}
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pt-6 lg:pt-12 space-x-2">
                        <a class="hover:text-orange-500" href="{{ route('meeskonnad') }}">{{ __('Tagasi') }}</a>
                    </div>
                </div>
            </main> 
            <x-footer></x-footer>
        </body>
    </html>
    @endauth
@endif