@php
    $hasVoted = session()->has('voted_' . $meeting->id);
@endphp

@if (!$hasVoted)
    <button
        class="btn btn-outline border-none text-black text-xl shadow-lg hover:shadow-none"
        onclick="votesModal.showModal()">{{ __('vote.addvotes') }}
    </button>
@else
    <button class="btn btn-outline border-none text-black text-xl shadow-2xl" disabled="disabled">
        <div class="text-gray-700">{{ __('vote.havevoted') }}</div>
    </button>
@endif

<dialog id="votesModal" class="modal">
    <form method="POST" action="{{ route('vote.store') }}" class="modal-box bg-white shadow-2xl">
        <a class="btn btn-circle btn-outline mb-4" onclick="document.getElementById('votesModal').close();">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>
        @csrf
        <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
        <div class="flex flex-col sm:justify-center items-center">
            <div>
                <div class="fill-current text-black text-4xl font-bold">{{ __('vote.voteonall') }}</div>
                <div class="fill-current text-black text-4xl font-bold mb-4">{{ __('vote.timesthat') }}</div>
            </div>
        </div>
        <h3 class="font-bold text-lg text-black">{{ __('vote.header') }}</h3>
        <p class="py-4 text-black">{{ __('vote.desctop') }}<br>
            {{ __('vote.descbot') }}</p>
        @if (count($meeting->dates) === 0)
            <p class="text-red-700 text-xl font-bold flex justify-center mt-4">{{ __('vote.unavailable') }}</p>
        @endif
        @if (count($meeting->dates) > 0)
            <x-input-label for="voted_by" :value="__('vote.yourname')"/>
            <x-text-input
                id="voted_by"
                class="block mt-1 w-full text-black"
                type="text"
                name="voted_by"
                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                required
                autofocus
                maxlength="50"
            />
            <x-input-error :messages="$errors->get('votes')" class="mt-2 text-red-700"/>
            @foreach($meeting->dates as $date)
                <input type="hidden" name="date_ids[]" value="{{ $date->id }}">
                <div class="form-control">
                    <label class="label cursor-pointer">
                            <span
                                class="label-text text-lg text-black font-bold">{{ __('vote.voteon') }} {{$date->date_and_time}}</span>
                        <div class="shadow-xl">
                            @php
                                $isDateTaken = \App\Models\Vote::where('date_id', $date->id)->exists();
                                $disableCheckbox = $meeting->is1v1 == 1 && $isDateTaken;
                            @endphp
                            @if ($disableCheckbox)
                                <input type="checkbox" name="votes[]" value="{{ $date->id }}"
                                       class="checkbox checkbox-lg checkbox-success" disabled>
                            @else
                                <input type="checkbox" name="votes[]" value="{{ $date->id }}"
                                       class="checkbox checkbox-lg checkbox-success">
                            @endif
                        </div>
                    </label>
                </div>
            @endforeach
            <div class="flex items-center justify-end mt-4">
                <x-primary-button type="submit" class="ml-4">
                    {{ __('vote.savevotes') }}
                </x-primary-button>
            </div>
        @endif
    </form>
</dialog>

<script>
    function adjustModalPosition() {
        const modal = document.getElementById('votesModal');
        const modalBox = modal.querySelector('.modal-box');

        const viewportHeight = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        const modalBoxHeight = modalBox.offsetHeight;

        if (modalBoxHeight > viewportHeight) {
            modalBox.style.top = '50px';
            modalBox.style.transform = 'translate(-50%, 0)';
        }
    }

    window.addEventListener('resize', adjustModalPosition);
    window.addEventListener('orientationchange', adjustModalPosition);
</script>
