@if (Auth::check() && $meeting->user_id == Auth::User()->id)
    <a href='/meeting/{{ $meeting->id }}/edit'>
        <button class='btn btn-warning shadow-xl'>Edit meeting and votes</button>
    </a>
    <a href='/meeting/{{ $meeting->id }}/delete'>
        <button class='btn btn-error shadow-xl'>Delete meeting</button>
    </a>
@endif
