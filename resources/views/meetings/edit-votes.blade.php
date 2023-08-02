<details class="collapse bg-white">
    <summary class="collapse-title text-xl text-black font-bold uppercase hover:bg-gray-300">
        Click here to edit votes
    </summary>
    <div class="collapse-content">
        <div class="uppercase font-bold text-black my-4">Select a time to edit votes:</div>

        @if($meeting->dates->isEmpty())
            <p class="text-black">No dates to edit votes.</p>
        @else
            @foreach($meeting->dates as $date)
                @if($date->votes->isEmpty())
                    <details class="collapse bg-white hover:bg-gray-200">
                        <summary class="collapse-title text-xl text-black font-medium">
                            Date and Time: <div>{{ $date->date_and_time }}</div>
                        </summary>
                        <div class="collapse-content">
                            <p class="text-black">No votes to edit for this date.</p>
                        </div>
                    </details>
                @else
                    <details class="collapse bg-white hover:bg-gray-200">
                        @foreach($date->votes as $vote)
                        <div class="mb-4 shadow-xl p-6 rounded-lg">
                            <form method="post" action="{{ route('vote.update', $vote->id) }}"
                                  class="flex items-center">
                                @csrf
                                @method('put')
                                <div class="mb-2">
                                    <x-input-label for="voted_by_{{ $vote->id }}" :value="__('EDIT VOTE NAME')"/>
                                    <x-text-input id="voted_by_{{ $vote->id }}" class="block mt-1 w-full text-black"
                                                  type="text"
                                                  name="voted_by" required maxlength="46"
                                                  value="{{ $vote->voted_by }}"/>
                                    <x-input-error :messages="$errors->get('voted_by')" class="mt-2"/>
                                </div>
                                <div>
                                    <x-primary-button type="submit" class="ml-2 mt-2.5  ">Save</x-primary-button>
                                </div>
                            </form>
                            <form method="post" action="{{ route('vote.destroy', $vote->id) }}">
                                @csrf
                                @method('delete')
                                <x-danger-button type="submit">Delete vote</x-danger-button>
                            </form>
                        </div>
                    </details>
                        @endforeach
                @endif
            @endforeach
        @endif
    </div>
</details>


