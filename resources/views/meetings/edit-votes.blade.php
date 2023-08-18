<details class="collapse bg-white">
    <summary class="collapse-title text-xl text-black font-bold uppercase hover:bg-gray-300">{{ __('edit-votes.clickhere') }}</summary>

    @if($meeting->dates->isNotEmpty())
        <div class="collapse-content">
            <div class="uppercase font-bold text-black my-4">{{ __('edit-votes.select') }}</div>

            @foreach($meeting->dates as $date)
                @include('partials.date', ['date' => $date])
            @endforeach
        </div>
    @else
        @include('partials.error', ['message' => __('edit-votes.nodates')])
    @endif
</details>
