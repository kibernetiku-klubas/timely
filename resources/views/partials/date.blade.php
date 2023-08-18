<details class="collapse bg-white hover:bg-gray-200">
    <summary class="collapse-title text-xl text-black font-medium">{{ __('edit-votes.date') }}
        <div>{{ $date->date_and_time }}</div>
    </summary>

    @if($date->votes->isNotEmpty())
        <div class="collapse-content">
            @foreach($date->votes as $vote)
                @include('partials.vote', ['vote' => $vote])
            @endforeach
        </div>
    @else
        @include('partials.error', ['message' => __('edit-votes.novotes')])
    @endif
</details>
