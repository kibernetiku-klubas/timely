@if ($isUserCreator)
    <a href='{{ route('meetings.show-finalize-date', $meeting->id) }}'>
        <x-secondary-button>{{ __('edit-meeting-buttons.finalize') }}</x-secondary-button>
    </a>

    <a href='/meeting/{{ $meeting->id }}/edit'>
        <x-secondary-button>{{ __('edit-meeting-buttons.edit') }}</x-secondary-button>
    </a>
    <a href='/meeting/{{ $meeting->id }}/delete'>
        <x-danger-button>{{ __('edit-meeting-buttons.delete') }}</x-danger-button>
    </a>
@endif
