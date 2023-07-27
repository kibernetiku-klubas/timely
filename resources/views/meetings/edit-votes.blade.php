<details class="collapse bg-white shadow-xl">
    <summary class="collapse-title text-xl text-black font-medium">Edit votes:</summary>
    <div class="collapse-content">
        <div>Select a time to edit votes:</div>
        @foreach($meeting->dates as $date)
            <details class="collapse bg-white border-2">
                <summary class="collapse-title text-xl text-black font-medium">Date and Time: {{ $date->date_and_time }}</summary>
                <div class="collapse-content">
                    @foreach($date->votes as $vote)
                        <div class="border-2 border-black">
                            <form method="post" action="{{ route('vote.update', $vote->id) }}">
                                @csrf
                                @method('put')
                                <label for="voted_by_{{ $vote->id }}">Edit Vote Name:</label>
                                <input type="text" name="voted_by" id="voted_by_{{ $vote->id }}" value="{{ $vote->voted_by }}"
                                       required>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                            <form method="post" action="{{ route('vote.destroy', $vote->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-error">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </details>

        @endforeach
    </div>
</details>

