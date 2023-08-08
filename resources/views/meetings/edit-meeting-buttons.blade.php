@if (Auth::check() && $meeting->user_id == Auth::User()->id)
    <a href='{{ route('meetings.show-finalize-date', $meeting->id) }}'>
        <x-secondary-button>Finalize date</x-secondary-button>
    </a>

    <a href='/meeting/{{ $meeting->id }}/edit'>
        <x-secondary-button>Edit meeting and votes</x-secondary-button>
    </a>
    <a href='/meeting/{{ $meeting->id }}/delete'>
        <x-danger-button>Delete meeting</x-danger-button>
    </a>
@endif
