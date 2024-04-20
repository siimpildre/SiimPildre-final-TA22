<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistika') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="mb-8">
                        <!--<form method="POST" action="{{ route('schedules.store') }}">
                            @csrf
                            <h2 class="font-semibold mt-6 text-xl text-gray-800 leading-tight">
                                {{ __('Lisa statistika') }}
                            </h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">{{ __('Avalda mäng') }}</x-primary-button>
                            </div>
                        </form> -->

                        <form method="GET" action="{{ route('statistics.create') }}">
                            <div class="mt-4">
                                <x-input-label for="schedule_id" :value="__('Vali mäng')" />
                                <select id="schedule_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                        name="schedule_id" required autofocus>
                                    <option value="">vali mäng</option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}">{{ $schedule->team1->team_name }} vs {{ $schedule->team2->team_name }} - {{ $schedule->date }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('schedule_id')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-primary-button>{{ __('Vaata statistikat') }}</x-primary-button>
                            </div>
                        </form>

                
                    


                    <div class="pt-4">
                        {{ $statistics->links() }}
                    </div>
                </div>
             </div>
        </div>
    </div>


</x-app-layout>