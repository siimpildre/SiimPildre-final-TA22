<div class="flex justify-end xs:hidden">
    <!-- Hamburger icon for mobile -->
        <button @click="open = !open" id="mobile-menu-toggle" class="block text-white focus:outline-none xs:hidden md:hidden">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>  

    <!-- Mobile menu -->
    <div id="mobile-menu" :class="{ 'block': open, 'hidden': !open }" class="hidden xs:hidden absolute top-14 inset-x-0 transition transform origin-top-right">
        <div class="shadow-lg opacity-85 bg-black divide-y divide-gray-100">
            <div class="px-5 py-6 text-right">
                <a href="{{ url('/meeskonnad') }}" class="block py-2 text-white hover:text-orange-500">Meeskonnad</a>
                <a href="{{ url('/mangijad') }}" class="block py-2 text-white hover:text-orange-500">Mängijad</a>
                <a href="{{ url('/tulemused') }}" class="block py-2 text-white hover:text-orange-500">Tulemused</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="block py-2 text-white hover:text-orange-500">Töölaud</a>
                    <a href="{{ route('logout') }}" class="block py-2 text-white hover:text-orange-500">Logi välja</a>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-white hover:text-orange-500">Logi sisse</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block py-2 text-white hover:text-orange-500">Registreeri</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Desktop menu -->
<div class="hidden sm:hidden md:flex lg:flex flex-1 justify-end items-center">
    @if (Route::has('login'))
        <nav class="flex flex-1 justify-end items-center">
            <x-g-nav-link href="{{ url('/meeskonnad') }}">Meeskonnad</x-g-nav-link>
            <x-g-nav-link href="{{ url('/mangijad') }}">Mängijad</x-g-nav-link>
            <x-g-nav-link href="{{ url('/tulemused') }}">Tulemused</x-g-nav-link>
            @auth
                <x-g-nav-link href="{{ url('/dashboard') }}">Töölaud</x-g-nav-link>
                <!-- Remove unnecessary container around form -->
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <x-g-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logi välja') }}
                    </x-g-nav-link>
                </form>
            @else
                <x-g-nav-link href="{{ route('login') }}">Logi sisse</x-g-nav-link>
                @if (Route::has('register'))
                    <x-g-nav-link href="{{ route('register') }}">Registreeri</x-g-nav-link>
                @endif
            @endauth
        </nav>
    @endif
</div>
