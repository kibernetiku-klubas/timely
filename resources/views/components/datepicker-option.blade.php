<label class="flex items-center mb-2">
    <input type="radio"
           name="selected_date"
           value="{{ $dateOption->id }}"
           class="mr-2 radio checked:bg-purple-500 radio-lg shadow-xl"
        {{ $checked ? 'checked' : '' }}>
    <div class="text-black">{{ $dateOption->date_and_time }}</div>
    <div class="ml-2 text-black uppercase">
        {{ __('finalize-date.votes') }} {{ $dateOption->votes->count() }}
    </div>
</label>
