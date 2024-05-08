<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uudised') }}
        </h2>
    </x-slot>
    <div class="p-6 py-12 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <form method="POST" action="{{ route('chirps.store') }}">
                @csrf
                <textarea name="message" placeholder="{{ __('Millest uudis räägib?') }}" class="block w-full border-gray-300 focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm lg:h-72"></textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Avalda uudis') }}</x-primary-button>
            </form>
        </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-4 w-4" src="{{ asset('icons/basketball.svg') }}" alt="Example Icon">
                                <div>
                                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, H:i') }}</small>
                                    @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                            </div>
                            <div>
                            @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Muuda') }}
                                        </x-dropdown-link>
                                    
                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Kustuta') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>