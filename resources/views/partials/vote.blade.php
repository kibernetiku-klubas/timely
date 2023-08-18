<div class="mb-4 shadow-xl p-6 rounded-lg">
    @include('partials.vote-form', ['vote' => $vote])

    <form method="post" action="{{ route('vote.destroy', $vote->id) }}">
        @csrf
        @method('delete')
        <x-danger-button type="submit">{{ __('edit-votes.delete') }}</x-danger-button>
    </form>
</div>
