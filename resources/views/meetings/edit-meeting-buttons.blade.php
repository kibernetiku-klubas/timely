@if (Auth::check() && $meeting->user_id == Auth::User()->id)
    <a href='/meeting/{{ $meeting->id }}/edit'>
        <x-secondary-button>{{ __('edit-meeting-buttons.edit') }}</x-secondary-button>
    </a>
    <a href='/meeting/{{ $meeting->id }}/delete'>
        <x-danger-button>{{ __('edit-meeting-buttons.delete') }}</x-danger-button>
    </a>
@endif
