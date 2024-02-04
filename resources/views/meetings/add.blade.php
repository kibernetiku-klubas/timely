<x-app-layout>
    <!-- Moment.js library, which is needed for getting user's timezone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    <!-- Script which detects the user's timezone -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('add.create') }}</div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('add.new') }}</div>
        </div>
    </div>
    <body data-page-title="{{ __('add.tab_name') }}"></body>
    <x-slot name="header">
        <h2 class="text-xl text-black leading-tight">
            {{ __('add.tab_name') }}
        </h2>
    </x-slot>
    <x-meet-form-layout>
        <dialog id="my_modal_1" class="modal">
            <form method="dialog" class="modal-box bg-white shadow-xl">
                <div class="modal-content">
                    <h3 class="font-bold text-lg text-black flex justify-center mb-8">{{ __('add.which') }}</h3>
                    <div class="flex flex-col lg:flex-col">
                        <div class="flex-1 text-black">
                            <div class="font-bold text-xl uppercase">{{ __('add.group') }}</div>
                            <p>{{ __('add.group_expl') }}</p>
                        </div>
                        <div class="divider text-black flex items-center justify-center flex-1">
                            {{ __('add.or') }}
                        </div>
                        <div class="flex-1 text-black">
                            <div class="font-bold text-xl uppercase">{{ __('add.1v1') }}</div>
                            <p>{{ __('add.1v1_expl') }}</p>
                        </div>
                    </div>
                    <div class="modal-action flex justify-center mt-4">
                        <button>
                            <x-primary-button>{{ __('add.ok') }}</x-primary-button>
                        </button>
                    </div>
                </div>
            </form>
        </dialog>


        <form method="POST" action="{{ route('meetings.store') }}">
            @csrf

            <div class="tooltip tooltip-right" data-tip="Which to choose?">
                <div class="font-bold text-md text-gray-700 inline-flex items-center">{{ __('add.select') }}
                    <span class="btn btn-ghost" onclick="my_modal_1.showModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="9" stroke="#33363F" stroke-width="2"/>
                        <circle cx="12" cy="18" r="0.5" fill="#33363F" stroke="#33363F"/>
                        <path
                            d="M12 16V14.5811C12 13.6369 12.6042 12.7986 13.5 12.5V12.5C14.3958 12.2014 15 11.3631 15 10.4189V9.90569C15 8.30092 13.6991 7 12.0943 7H12C10.3431 7 9 8.34315 9 10V10"
                            stroke="#33363F" stroke-width="2"/>
                    </svg>
                </span>
                </div>
            </div>

            <div class="flex justify-center">
                <label class="card bg-white shadow-xl m-2 radio-label">
                    <input type="radio" name="is1v1" value="0" required class="radio-input"
                        {{ old('is1v1') === '0' ? 'checked' : '' }} />
                    <div class="card-body text-black">
                        <div class="flex justify-center">
                            <svg fill="#000000" width="45" height="45" viewBox="0 0 56 56"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M 28.0000 27.1257 C 31.1936 27.1257 33.9415 24.2737 33.9415 20.5602 C 33.9415 16.8912 31.1787 14.1729 28.0000 14.1729 C 24.8213 14.1729 22.0584 16.9506 22.0584 20.5898 C 22.0584 24.2737 24.8064 27.1257 28.0000 27.1257 Z M 10.9029 27.4673 C 13.6658 27.4673 16.0722 24.9718 16.0722 21.7485 C 16.0722 18.5548 13.6509 16.1930 10.9029 16.1930 C 8.1401 16.1930 5.7040 18.6143 5.7188 21.7782 C 5.7188 24.9718 8.1252 27.4673 10.9029 27.4673 Z M 45.0970 27.4673 C 47.8748 27.4673 50.2811 24.9718 50.2811 21.7782 C 50.2811 18.6143 47.8599 16.1930 45.0970 16.1930 C 42.3491 16.1930 39.9278 18.5548 39.9278 21.7485 C 39.9278 24.9718 42.3342 27.4673 45.0970 27.4673 Z M 2.6143 40.8806 L 13.9035 40.8806 C 12.3586 38.6376 14.2451 34.1220 17.4387 31.6562 C 15.7899 30.5570 13.6658 29.7400 10.8881 29.7400 C 4.1889 29.7400 0 34.6864 0 38.8010 C 0 40.1379 .7427 40.8806 2.6143 40.8806 Z M 53.3856 40.8806 C 55.2723 40.8806 56 40.1379 56 38.8010 C 56 34.6864 51.8113 29.7400 45.1119 29.7400 C 42.3342 29.7400 40.2102 30.5570 38.5613 31.6562 C 41.7549 34.1220 43.6414 38.6376 42.0966 40.8806 Z M 18.6568 40.8806 L 37.3283 40.8806 C 39.6604 40.8806 40.4925 40.2122 40.4925 38.9050 C 40.4925 35.0726 35.6944 29.7845 27.9851 29.7845 C 20.2907 29.7845 15.4928 35.0726 15.4928 38.9050 C 15.4928 40.2122 16.3247 40.8806 18.6568 40.8806 Z"/>
                            </svg>
                        </div>
                        <div class="card-title uppercase">{{ __('add.group') }}</div>
                    </div>
                </label>
                <label class="card bg-white shadow-xl m-2 radio-label">
                    <input type="radio" name="is1v1" value="1" required class="radio-input"
                        {{ old('is1v1') === '1' ? 'checked' : '' }}/>
                    <div class="card-body text-black">
                        <div class="flex justify-center">
                            <svg fill="#000000" width="40" height="40" viewBox="0 0 56 56"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M 28.0117 27.3672 C 33.0508 27.3672 37.3867 22.8672 37.3867 17.0078 C 37.3867 11.2187 33.0274 6.9297 28.0117 6.9297 C 22.9961 6.9297 18.6367 11.3125 18.6367 17.0547 C 18.6367 22.8672 22.9961 27.3672 28.0117 27.3672 Z M 13.2930 49.0703 L 42.7305 49.0703 C 46.4101 49.0703 47.7226 48.0156 47.7226 45.9531 C 47.7226 39.9062 40.1523 31.5625 28.0117 31.5625 C 15.8477 31.5625 8.2774 39.9062 8.2774 45.9531 C 8.2774 48.0156 9.5898 49.0703 13.2930 49.0703 Z"/>
                            </svg>
                        </div>
                        <div class="card-title uppercase">{{ __('add.1v1') }}</div>
                    </div>
                </label>
            </div>

            <style>
                .radio-input {
                    position: absolute;
                    opacity: 0;
                    pointer-events: none;
                }

                .radio-input:checked + div {
                    background-color: #9ca3af;
                    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
                    border-radius: 0.5rem; /* 8px */
                }
            </style>


            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('add.title')"/>
                <x-text-input id="title" class="block mt-1 w-full text-black" type="text" name="title"
                              :value="old('title')"
                              required autofocus autocomplete="title" maxlength="46"
                              placeholder="{{ __('add.title_placeholder') }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>
            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('add.desc')"/>
                <x-textarea type="textarea" id="description" required autofocus autocomplete="description"
                            placeholder="Briefly describe what the meeting is about..." maxlength="1000"
                            name="description" class="text-black w-full">{{old('description')}}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>
            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('add.location')"/>
                <x-text-input id="location"
                              class="block mt-1 w-full text-black"
                              type="text" name="location" :value="old('location')" required autofocus
                              autocomplete="location" placeholder="{{ __('add.location_placeholder') }}"
                              maxlength="50"/>
                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
            </div>
            <!-- Timezone -->
            <div>
                @php
                    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                @endphp
                <x-input-label for="timezone" :value="__('add.timezone')"/>
                <select name="timezone" id="timezone" type="string"
                        class="border border-gray-300 text-black rounded-lg w-full mt-1 bg-white text-md focus:border-purple-500 focus:purple-500">
                    <option value="default">{{ __('add.selecttimezone') }}</option>
                    @foreach($timezones as $timezone)
                        <option value="{{ $timezone }}">
                            {{ $timezone }}
                        </option>
                    @endforeach
                </select>
                @error('timezone')
                <p class="text-red-500 text-sm">{{ __('add.mustselect') }}</p>
                @enderror
            </div>
            <!-- Duration -->
            <div>
                <x-input-label for="duration" :value="__('add.duration')"/>
                <x-text-input type="smallInteger" id="duration"
                              class="block mt-1 w-full border border-gray-300 focus:border-purple-500 focus:purple-500 bg-white p-2 text-black"
                              type="string" name="duration" :value="old('duration')" required autofocus
                              autocomplete="duration" placeholder="{{ __('add.duration_placeholder') }}"/>
                <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
            </div>
            {{--            <!-- Delete_after -->--}}
            {{--            <div>--}}
            {{--                <x-input-label for="delete_after" :value="__('add.delete_after')"/>--}}
            {{--                <x-text-input type="integer" id="delete_after"--}}
            {{--                              class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"--}}
            {{--                              type="string" name="delete_after" :value="old('delete_after')" required autofocus--}}
            {{--                              autocomplete="delete_after" placeholder="{{ __('add.deletion_placeholder') }}"/>--}}
            {{--                <x-input-error :messages="$errors->get('delete_after')" class="mt-2"/>--}}
            {{--            </div>--}}


            <!-- Advanced options -->
            <div class="divider"></div>
            <div>
                <details class="collapse collapse-arrow bg-white my-2 md:my-0 md:w-1/2">
                    <summary
                        class="collapse-title text-lg font-bold hover:bg-gray-300 text-gray-700">{{ __('add.additionaloptions') }}</summary>
                    <div class="collapse-content px-4 md:px-6">
                        <div class="my-4">
                            {{--Invisible voters--}}
                            <x-input-label class="flex items-center justify-between space-x-2">
                                <span
                                    class="block font-bold text-md text-gray-700 uppercase">{{ __('add.voteinvis') }}</span>
                                <input type="checkbox" name="voter_invisible" value="1"
                                       class="checkbox checkbox-md" {{ old('voter_invisible') ? 'checked' : '' }}>
                            </x-input-label>
                        </div>
                        <div>
                            {{--Voting Deadline--}}
                            {{--<x-input-label for="voting_deadline" :value="__('add.voting_deadline')"/>--}}
                            {{--<x-text-input type="integer" id="voting_deadline"--}}
                            {{--class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"--}}
                            {{--type="string" name="voting_deadline" :value="old('voting_deadline', 0)"--}}
                            {{--required autofocus--}}
                            {{--autocomplete="voting_deadline" placeholder="{{ __('add.deadlinetext') }}"/>--}}
                            {{--<x-input-error :messages="$errors->get('voting_deadline')" class="mt-2"/>--}}
                        </div>
                        <div class="my-4">
                            {{--Custom link--}}
                            <x-input-label for="custom_url" class="text-black text-md uppercase"
                                           :value="__('add.customlinklabel')"/>
                            <div class="flex items-center justify-between space-x-1">
                                <span class="text-lg text-gray-700">{{ str_replace(' ', '-', Auth::user()->name) }}/</span>
                                <x-text-input type="text" id="custom_url"
                                              class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                                              name="custom_url" :value="old('custom_url')"
                                              placeholder="{{ __('add.entercustomurl') }}" maxlength="46"/>
                            </div>
                            <x-input-error :messages="$errors->get('custom_url')" class="mt-2"/>
                        </div>
                    </div>
                </details>
            </div>
            <!-- Creation buttons -->
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('dashboard') }}" tabindex="-1">
                    <x-secondary-button class="ml-4">
                        {{ __('add.cancel') }}
                    </x-secondary-button>
                </a>
                <x-primary-button type="submit" class="ml-4">
                    {{ __('add.confirm') }}
                </x-primary-button>
            </div>
        </form>
    </x-meet-form-layout>
</x-app-layout>
<script>
    function toggleCheckboxes() {
        let checkboxesDiv = document.getElementById('checkboxes');
        checkboxesDiv.classList.toggle('hidden');
    }
</script>
