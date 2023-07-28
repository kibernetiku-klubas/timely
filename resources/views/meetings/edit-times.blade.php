@if ($user->id == $meeting->user_id)
    <details class="collapse bg-white mb-6">
        <summary class="collapse-title text-xl font-bold text-center">
            <div class="flex items-center justify-center">
                <div class="btn btn-ghost text-xl font-bold shadow-lg">ADD TIMES
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                         class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
            </div>
        </summary>
        <div class="collapse-content flex flex-col items-center">
            <x-flatpickr::style/>

            <form method="POST" action="{{ route('dates.store') }}">
                @csrf
                <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>
                <div class="mt-4 flex items-center space-x-2">
                    <div class="mb-2">
                        <x-input-label for="new_time" :value="__('SELECT A NEW TIME')"/>
                        <x-flatpickr name='new_time' show-time :min-date="now()->addMinutes(30)"
                                     :max-date="today()->addDays(90)" required/>
                        <x-input-error :messages="$errors->get('new_time')" class="mt-2"/>
                    </div>
                    <div class="mt-2.5">
                        <x-primary-button>
                            {{ __('Add time') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>

            <x-flatpickr::script/>
        </div>
    </details>
@endif
