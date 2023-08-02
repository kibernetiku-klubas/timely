@php
    $hasVoted = session()->has('voted_' . $meeting->id);
@endphp
@if (!$hasVoted)
        <button
            class="btn btn-outline border-none text-black text-xl shadow-lg hover:shadow-none"
            onclick="votesModal.showModal()">ADD YOUR VOTES
        </button>
@else
        <button class="btn btn-outline border-none text-black text-xl shadow-2xl" disabled="disabled">
            <div class="text-gray-700">You have already voted</div>
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
                <div class="fill-current text-black text-4xl font-bold">VOTE ON ALL THE</div>
                <div class="fill-current text-black text-4xl font-bold mb-4">TIMES THAT SUIT YOU.</div>
            </div>
        </div>
        <h3 class="font-bold text-lg text-black">Check every time you want to vote on and enter your name to
            save your votes</h3>
        <p class="py-4 text-black">Note: Name will be visible to everyone viewing this meeting.<br>
            It is also recommended to use your real name so that meeting creator knows who voted.</p>
        @if (count($meeting->dates) === 0)
            <p class="text-red-700 text-xl font-bold flex justify-center mt-4">NO DATES AVAILABLE FOR
                VOTING</p>
        @endif
        @if (count($meeting->dates) > 0)
            <div>
                <x-input-label for="voted_by" :value="__('YOUR NAME')"/>
                <x-text-input id="voted_by" class="block mt-1 w-full text-black" type="text" name="voted_by"
                              :value="old('voted_by')" required autofocus maxlength="50"/>
                <x-input-error :messages="$errors->get('votes')" class="mt-2 text-red-700"/>
            </div>
            @foreach($meeting->dates as $date)
                <input type="hidden" name="date_ids[]" value="{{ $date->id }}">
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text text-lg text-black font-bold">VOTE ON: {{$date->date_and_time}}</span>
                        <div class="shadow-xl">
                            <input type="checkbox" name="votes[]" value="{{ $date->id }}"
                                   class="checkbox checkbox-lg checkbox-success">
                        </div>
                    </label>
                </div>
            @endforeach
            <div class="flex items-center justify-end mt-4">
                <x-primary-button type="submit" class="ml-4">
                    {{ __('Save votes') }}
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
