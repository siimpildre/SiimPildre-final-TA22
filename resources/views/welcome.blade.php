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
            .background-container {
                /* Set background size to cover entire container */
                background-size: cover;
                
                /* Set background position to center */
                background-position: center;
                
                /* Ensure the container takes up the entire viewport */
                width: 100vw;
                height: 100vh;
            }

            @media (max-width: 767px) {
                .sm\:custom-heading {
                    font-size: 40px;
                    text-transform: uppercase;
                    text-align: center;
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
        <header class="background-container bg-banner-ball">
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
                    <div class="flex pb-2 pt-44 justify-center">
                        <h1 class="lg:custom-heading sm:custom-heading md:custom-heading lg:custom-heading lg:py-2 text-white">
                            Saaremaa Korvpall
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="bg-ball-basket">

        </main>
        <footer>

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
