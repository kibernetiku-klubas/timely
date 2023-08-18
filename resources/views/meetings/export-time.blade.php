@if($selectedDate)
    <a href="{{ route('export.ics', $selectedDate->id)}}"
       class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl">
        {{ __('meeting-cards.export') }}
    </a>
@endif
