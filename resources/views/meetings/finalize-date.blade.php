<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('finalize-date.finalize') }}</div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('finalize-date.time') }}</div>
        </div>
    </div>
    <x-meet-form-layout>
        <form method="POST" action="{{ route('dates.finalize-date', $meeting->id) }}">
            @csrf
            <p class='text-black mt-2 font-medium'>{{ __('finalize-date.mark') }}</p>
            <p class='text-black font-bold text-xl uppercase mt-4'>{{ __('finalize-date.select') }}</p>

            <div class="mt-2">
                @foreach($sortedDates as $index => $dateOption)
                    <x-datepicker-option
                        :dateOption="$dateOption"
                        :checked="$index === 0"
                    />
                @endforeach
            </div>

            <div class="mt-6">
                <a href="{{ route('meeting.show', $meeting->id) }}">
                    <x-secondary-button>{{ __('finalize-date.cancel') }}</x-secondary-button>
                </a>
                <x-primary-button type="submit" class="ml-2">{{ __('finalize-date.confirm') }}</x-primary-button>
            </div>
        </form>
    </x-meet-form-layout>
</x-app-layout>
