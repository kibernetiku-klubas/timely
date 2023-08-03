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
            <div class="fill-current text-black text-4xl font-bold">EDIT A</div>
            <div class="fill-current text-black text-4xl font-bold">MEETING.</div>
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
            @endphp
                <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('TITLE')"/>
                <x-text-input id="title" class="block mt-1 w-full text-black" type="text" name="title"
                              :value="$title"
                              required autofocus autocomplete="title" maxlength="46" placeholder="Meeting Title"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>
            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('Description')"/>
                <x-textarea type="textarea" id="description" required autofocus autocomplete="description"
                            name="description" maxlength="1000">{{ $desc }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>
            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('LOCATION')"/>
                <x-text-input id="location"
                              class="block mt-1 w-full text-black"
                              type="text" name="location" :value="$location" required autofocus
                              autocomplete="location" placeholder="Meeting Location (e.g., Conference Room A, Online)"
                              maxlength="50"/>
                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
            </div>
            <!-- Timezone -->
            <div>
                @php
                    $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                @endphp
                <x-input-label for="timezone" :value="__('TIMEZONE')"/>
                <select name="timezone" id="timezone" type="string"
                        class="border border-gray-300 text-black rounded-lg w-full mt-1 bg-white text-md focus:border-purple-500 focus:purple-500">
                    <option value="default">Please select a timezone</option>
                    @foreach($timezones as $timezone)
                        <option value="{{ $timezone }}">
                            {{ $timezone }}
                        </option>
                    @endforeach
                </select>
                @error('timezone')
                <p class="text-red-500 text-sm">{{ "Timezone must be selected." }}</p>
                @enderror
            </div>
            <!-- Duration -->
            <div>
                <x-input-label for="duration" :value="__('MEETING DURATION (MIN):')"/>
                <x-text-input type="smallInteger" id="duration"
                              class="block mt-1 w-full border border-gray-300 focus:border-purple-500 focus:purple-500 bg-white p-2 text-black"
                              type="string" name="duration" :value="$duration" required autofocus
                              autocomplete="duration" placeholder="Estimated Meeting Duration"/>
                <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
            </div>
            <!-- Delete_after -->
            <div>
                <x-input-label for="delete_after" :value="__('DELETE AFTER (DAYS) FROM CREATION:')"/>
                <x-text-input type="integer" id="delete_after"
                              class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                              type="string" name="delete_after" :value="$delete_after" required autofocus
                              autocomplete="delete_after" placeholder="Choose time until deletion"/>
                <x-input-error :messages="$errors->get('delete_after')" class="mt-2"/>
            </div>

            <input type="hidden" value="{{$meeting->is1v1}}" name="is1v1">

            <!-- Save meeting -->
            <div class="flex items-center justify-end my-4">
                <a href="/meetings/{{ $meeting->id }}   " tabindex="-1">
                    <x-secondary-button class="mr-2">
                        Cancel
                    </x-secondary-button>
                </a>
                <x-primary-button>
                    update meeting
                </x-primary-button>
            </div>
        </form>
        @include('meetings.edit-votes')
    </x-meet-form-layout>
</x-app-layout>

