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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="./teams" class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-2 bg-blue-500 text-white">
                    <h2 class="text-lg font-bold">Meeskonnad</h2>
                </div>
                <div class="px-4 py-2">
                    <p class="text-gray-700">Vaata ja muuda meeskonna infot siit</p>
                </div>
            </a>

            <a href="./players" class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-2 bg-blue-500 text-white">
                    <h2 class="text-lg font-bold">Mängijad</h2>
                </div>
                <div class="px-4 py-2">
                    <p class="text-gray-700">Vaata ja muuda mängijate infot siit</p>
                </div>
            </a>

            <a href="./" class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-2 bg-blue-500 text-white">
                    <h2 class="text-lg font-bold">Ajakava</h2>
                </div>
                <div class="px-4 py-2">
                    <p class="text-gray-700">Vaata ja muuda ajakava</p>
                </div>
            </a>

            <a href="./" class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-2 bg-blue-500 text-white">
                    <h2 class="text-lg font-bold">Uudised</h2>
                </div>
                <div class="px-4 py-2">
                    <p class="text-gray-700">vaata või loo uusi uudiseid</p>
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
