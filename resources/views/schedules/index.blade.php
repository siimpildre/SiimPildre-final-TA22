<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajakava') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <!-- <form method="POST" action="{{ route('schedule.store') }}">
                        @csrf
                        <h2 class="font-semibold mt-6 text-xl text-gray-800 leading-tight">
                            {{ __('Lisa uus meeskond') }}
                        </h2>

                    </form> -->
                    
                    <form method="POST" action="{{ route('schedules.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="team1_id" class="block text-gray-700">Team 1:</label>
                            <select name="team1_id" id="team1_id" class="form-select mt-1 block w-full">
                                <option value="">Select Team 1</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="team2_id" class="block text-gray-700">Team 2:</label>
                            <select name="team2_id" id="team2_id" class="form-select mt-1 block w-full">
                                <option value="">Select Team 2</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="block text-gray-700">Date:</label>
                            <input type="date" name="date" id="date" class="form-input mt-1 block w-full" />
                        </div>

                        <div class="mb-4">
                            <label for="time" class="block text-gray-700">Time:</label>
                            <input type="time" name="time" id="time" class="form-input mt-1 block w-full" />
                        </div>

                        <div class="mb-4">
                            <label for="venue" class="block text-gray-700">Venue:</label>
                            <input type="text" name="venue" id="venue" class="form-input mt-1 block w-full" />
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Schedule</button>
                        </div>
                    </form>



                </div>
             </div>
        </div>
    </div>


</x-app-layout>