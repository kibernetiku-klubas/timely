@if (Auth::check() && $meeting->user_id == Auth::User()->id)
    <a href='/meeting/{{ $meeting->id }}/edit'>
        <x-secondary-button>Edit meeting and votes</x-secondary-button>
    </a>
    <a href='/meeting/{{ $meeting->id }}/delete'>
        <x-danger-button>Delete meeting</x-danger-button>
    </a>
@endif
