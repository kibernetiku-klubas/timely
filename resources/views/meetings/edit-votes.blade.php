<details class="collapse bg-white">
    <summary class="collapse-title text-xl text-black font-bold uppercase hover:bg-gray-300">{{ __('edit-votes.clickhere') }}
    </summary>
    @if($meeting->dates->isNotEmpty())
    <div class="collapse-content">
        <div class="uppercase font-bold text-black my-4">{{ __('edit-votes.select') }}</div>

        @foreach($meeting->dates as $date)
            <details class="collapse bg-white hover:bg-gray-200">
                <summary class="collapse-title text-xl text-black font-medium">{{ __('edit-votes.date') }}
                    <div>{{ $date->date_and_time }}</div>
                </summary>

                @if($date->votes->isNotEmpty())
                <div class="collapse-content">
                    @foreach($date->votes as $vote)
                        <div class="mb-4 shadow-xl p-6 rounded-lg">
                            <form method="post" action="{{ route('vote.update', $vote->id) }}"
                                  class="flex items-center">
                                @csrf
                                @method('put')
                                <div class="mb-2">
                                    <x-input-label for="voted_by_{{ $vote->id }}" :value="__('edit-votes.editname')"/>
                                    <x-text-input id="voted_by_{{ $vote->id }}" class="block mt-1 w-full text-black"
                                                  type="text"
                                                  name="voted_by" required maxlength="46"
                                                  value="{{ $vote->voted_by }}"/>
                                    <x-input-error :messages="$errors->get('voted_by')" class="mt-2"/>
                                </div>
                                <div>
                                    <x-primary-button type="submit" class="ml-2 mt-2.5  ">{{ __('edit-votes.save') }}</x-primary-button>
                                </div>
                            </form>
                            <form method="post" action="{{ route('vote.destroy', $vote->id) }}">
                                @csrf
                                @method('delete')
                                <x-danger-button type="submit">{{ __('edit-votes.delete') }}</x-danger-button>
                            </form>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="text-md font-bold text-red-600 flex justify-center uppercase">{{ __('edit-votes.novotes') }}</div>
                @endif


            </details>

        @endforeach
    </div>
    @else
    <div class="text-lg font-bold text-red-600 flex justify-center uppercase">{{ __('edit-votes.nodates') }}</div>
    @endif
</details>
