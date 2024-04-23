<x-guest-layout>
    <div class="mb-4 text-sm text-gray-200">
        {{ __('Täname registreerumast! Kas saaksite enne alustamist oma e-posti aadressi kinnitada, klõpsates lingil, mille just Teile meili saatsime? Kui Te e-kirja ei saanud, saadame Teile hea meelega uue.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Registreerimisel sisestatud emailile on saadetud uus kinnituslink.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Saatke kinnitusmeil uuesti') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-200 hover:text-orange-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                {{ __('Logi välja') }}
            </button>
        </form>
    </div>
</x-guest-layout>
