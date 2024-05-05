<x-app-layout>
    <x-slot name="header" >
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Töölaud') }}
        </h2>
        <h2 id="messageDiv" class="text-gray-900 leading-tight">
            {{ __("Oled sisse logitud!") }}
        </h2>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 p-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="./teams" class="bg-orange-600 hover:bg-orange-700 shadow-lg rounded-lg overflow-hidden text-gray-600 hover:text-gray-800">
                <div class="px-4 py-2  text-white">
                    <h2 class="text-lg font-bold">Meeskonnad</h2>
                </div>
                <div>
                    <img class="block h-9 w-auto fill-current bg-white text-gray-600" src="/public/icons/team-add.svg" alt="team-icon">
                </div>
                <div class="px-4 py-2 bg-white">
                    <p>Vaata ja muuda meeskonna infot</p>
                </div>
            </a>

            <a href="./players" class="bg-orange-600 hover:bg-orange-700 shadow-lg rounded-lg overflow-hidden text-gray-600 hover:text-gray-800">
                <div class="px-4 py-2  text-white">
                    <h2 class="text-lg font-bold">Mängijad</h2>
                </div>
                <div class="px-4 py-2 bg-white">
                    <img class="block h-9 w-auto fill-current" src="/public/icons/jersey.svg" alt="jersey-icon">
                    <p>Vaata ja muuda mängijate infot</p>
                </div>
            </a>

            <a href="./schedules" class="bg-orange-600 hover:bg-orange-700 shadow-lg rounded-lg overflow-hidden text-gray-600 hover:text-gray-800">
                <div class="px-4 py-2 text-white">
                    <h2 class="text-lg font-bold">Ajakava</h2>
                </div>
                <div class="px-4 py-2 bg-white">
                    <img class="block h-9 w-auto fill-current" src="/public/icons/schedule.svg" alt="schedule-icon">
                    <p>Vaata ja muuda ajakava</p>
                </div>
            </a>

            <a href="./chirps" class="bg-orange-600 hover:bg-orange-700 shadow-lg rounded-lg overflow-hidden text-gray-600 hover:text-gray-800">
                <div class="px-4 py-2  text-white">
                    <h2 class="text-lg font-bold">Uudised</h2>
                </div>
                <div class="px-4 py-2 bg-white">
                    <img class="block h-9 w-auto fill-current" src="/public/icons/news.svg" alt="news-icon">
                    <p>Vaata või loo uusi uudiseid</p>
                </div>
            </a>
            <a href="./statistics" class="bg-orange-600 hover:bg-orange-700 shadow-lg rounded-lg overflow-hidden text-gray-600 hover:text-gray-800">
                <div class="px-4 py-2 text-white">
                    <h2 class="text-lg font-bold">Statistika</h2>
                </div>
                <div class="px-4 py-2 bg-white">
                    <img class="block h-9 w-auto fill-current" src="/public/icons/statistics.svg" alt="statistics-icon">
                    <p>Sisesta või muuda mängude statistikat</p>
                </div>
            </a>

    </div>
    


</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let messageDiv = document.getElementById('messageDiv');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    });
</script>
