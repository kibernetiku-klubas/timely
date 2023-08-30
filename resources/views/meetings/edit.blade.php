<x-app-layout>
    <!-- Moment.js library, which is needed for getting user's timezone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    <!-- Script which detects the user's timezone -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <body data-page-title="Edit meeting"></body>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('edit-meeting.edita') }}</div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('edit-meeting.meeting') }}</div>
        </div>
    </div>
    <x-meet-form-layout>
        <form method="POST" action="{{ route('meetings.update', $id = $meeting->id) }}">
            @csrf
            @method('patch')
            @php
                $title = old('title') ?: $meeting->title;
                $desc = old('description') ?: $meeting->description;
                $location = old('location') ?: $meeting->location;
                $duration = old('duration') ?: $meeting->duration;
                $delete_after = old('delete_after') ?: $meeting->delete_after;
                $voting_deadline = old('voting_deadline') ?: $meeting->voting_deadline;
                $custom_url = old('custom_url') ?: $meeting->custom_url;
            @endphp
                <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('edit-meeting.title')"/>
                <x-text-input id="title" class="block mt-1 w-full text-black" type="text" name="title"
                              :value="$title"
                              required autofocus autocomplete="title" maxlength="46"
                              placeholder="{{ __('edit-meeting.title_placeholder') }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>
            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('edit-meeting.desc')"/>
                <x-textarea type="textarea" id="description" required autofocus autocomplete="description"
                            name="description" maxlength="1000">{{ $desc }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>
            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('edit-meeting.location')"/>
                <x-text-input id="location"
                              class="block mt-1 w-full text-black"
                              type="text" name="location" :value="$location" required autofocus
                              autocomplete="location" placeholder="{{ __('edit-meeting.location_placeholder') }}"
                              maxlength="50"/>
                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
            </div>
            <!-- Timezone -->
            <div>
                @php
                    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                @endphp
                <x-input-label for="timezone" :value="__('edit-meeting.timezone')"/>
                <select name="timezone" id="timezone" type="string"
                        class="border border-gray-300 text-black rounded-lg w-full mt-1 bg-white text-md focus:border-purple-500 focus:purple-500">
                    <option value="default">{{ __('edit-meeting.selecttimezone') }}</option>
                    @foreach($timezones as $timezone)
                        <option value="{{ $timezone }}">
                            {{ $timezone }}
                        </option>
                    @endforeach
                </select>
                @error('timezone')
                <p class="text-red-500 text-sm">{{ __('edit-meeting.mustselect') }}</p>
                @enderror
            </div>
            <!-- Duration -->
            <div>
                <x-input-label for="duration" :value="__('edit-meeting.duration')"/>
                <x-text-input type="smallInteger" id="duration"
                              class="block mt-1 w-full border border-gray-300 focus:border-purple-500 focus:purple-500 bg-white p-2 text-black"
                              type="string" name="duration" :value="$duration" required autofocus
                              autocomplete="duration" placeholder="{{ __('edit-meeting.duration_placeholder') }}"/>
                <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
            </div>
            <!-- Delete_after -->
            <div>
                <x-input-label for="delete_after" :value="__('edit-meeting.delete_after')"/>
                <x-text-input type="integer" id="delete_after"
                              class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                              type="string" name="delete_after" :value="$delete_after" required autofocus
                              autocomplete="delete_after" placeholder="{{ __('edit-meeting.deletion_placeholder') }}"/>
                <x-input-error :messages="$errors->get('delete_after')" class="mt-2"/>
            </div>
            <!-- Advanced options -->
            <div>
                <div class="font-bold text-md text-gray-700 inline-flex relative">
                    <div>
                        <x-input-label class="cursor-pointer mr-2" onclick="toggleCheckboxes()">
                            {{ __('edit-meeting.advanced') }}
                        </x-input-label>
                        <div id="checkboxes" class="bg-white shadow-md rounded-lg p-2 space-y-2 hidden mt-2">
                            <x-input-label class="flex items-center space-x-2">
                                <input type="checkbox" name="voter_invisible" value="1"
                                       class="form-checkbox text-purple-500" {{ $meeting->voter_invisible ? 'checked' : '' }}>
                                <span>{{ __('edit-meeting.voteinvis') }}</span>
                            </x-input-label>
                            <x-input-label for="voting_deadline" :value="__('add.voting_deadline')"/>
                            <x-text-input type="integer" id="voting_deadline"
                                          class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                                          type="string" name="voting_deadline" :value="$voting_deadline" required
                                          autofocus
                                          autocomplete="voting_deadline" placeholder="{{ __('add.deadlinetext') }}"/>
                            <x-input-error :messages="$errors->get('voting_deadline')" class="mt-2"/>

                            <x-input-label for="custom_url"
                                           :value="__('Enter a custom URL for a meeting (leave empty for default)')"/>
                            <x-text-input type="text" id="custom_url"
                                          class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                                          name="custom_url" :value="old('custom_url')" :value="$custom_url"
                                          placeholder="{{ __('Enter custom URL') }}" maxlength="46"/>
                            <x-input-error :messages="$errors->get('custom_url')" class="mt-2"/>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" value="{{$meeting->is1v1}}" name="is1v1">

            <!-- Save meeting -->
            <div class="flex items-center justify-end my-4">
                <a href="/meetings/{{ $meeting->id }}   " tabindex="-1">
                    <x-secondary-button class="mr-2">
                        {{ __('edit-meeting.cancel') }}
                    </x-secondary-button>
                </a>
                <x-primary-button>
                    {{ __('edit-meeting.update') }}
                </x-primary-button>
            </div>
        </form>
        @include('meetings.edit-votes')
    </x-meet-form-layout>
</x-app-layout>
<script>
    function toggleCheckboxes() {
        var checkboxesDiv = document.getElementById('checkboxes');
        checkboxesDiv.classList.toggle('hidden');
    }
</script>
