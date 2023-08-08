<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">FINALIZE</div>
            <div class="fill-current text-black text-4xl font-bold">DATE.</div>
        </div>
    </div>
    <x-meet-form-layout>
        <form method="POST" action="{{ route('meetings.finalize-date', $meeting->id) }}">
            @csrf
            <h2 class='text-2xl text-black font-bold uppercase'>Finalize Meeting Date</h2>
            <p class='text-black uppercase mt-4'>This will mark a date as final for everyone. You can still
                change this later.
            </p>
            <p class='text-red-700 uppercase mt-4'>Select a date to finalize:</p>

            @php
                $sortedDates = $meeting->dates->sortByDesc(function ($date) {
                    return $date->votes->count();
                });
            @endphp

            <div class="mt-2">
                @foreach($sortedDates as $dateOption)
                <label class="block cursor-pointer flex items-center mb-2">
                    <input type="radio" name="selected_date" value="{{ $dateOption->id }}" class="mr-2">
                    <div class="text-black">{{ $dateOption->date_and_time }}</div>
                    <div class="ml-2 text-black uppercase">Votes: {{ $dateOption->votes->count() }}</div>
                </label>
            @endforeach
            </div>

            <div class="mt-6">
                <a href="{{ route('meeting.show', $meeting->id) }}">
                    <x-secondary-button>Cancel</x-secondary-button>
                </a>
                <x-danger-button type="submit" class="ml-2">Confirm</x-danger-button>
            </div>
        </form>
    </x-meet-form-layout>
</x-app-layout>
