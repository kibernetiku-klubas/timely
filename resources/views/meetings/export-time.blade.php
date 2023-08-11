@php
    $date = $meeting->dates->where('selected', 1)->first();
@endphp
@if($date)
    <a href="{{ route('export.ics', $date->id)}}"
       class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl">
        {{ __('meeting-cards.export') }}
    </a>
@endif
