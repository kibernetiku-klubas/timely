<form method="post" action="{{ route('vote.update', $vote->id) }}" class="flex items-center">
    @csrf
    @method('put')

    <div class="mb-2">
        <x-input-label for="voted_by_{{ $vote->id }}" :value="__('edit-votes.editname')"/>
        <x-text-input id="voted_by_{{ $vote->id }}" class="block mt-1 w-full text-black" type="text" name="voted_by"
                      required maxlength="46" value="{{ $vote->voted_by }}"/>
        <x-input-error :messages="$errors->get('voted_by')" class="mt-2"/>
    </div>

    <div>
        <x-primary-button type="submit" class="ml-2 mt-2.5">{{ __('edit-votes.save') }}</x-primary-button>
    </div>
</form>
