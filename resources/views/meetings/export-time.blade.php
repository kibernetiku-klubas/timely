@if($selectedDate)
    <a href="{{ route('export.ics', ['meeting_id' => $meeting->id, 'date_id' => $selectedDate->id])}}"
       class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl">
        {{ __('meeting-cards.export') }}
    </a>
@endif
