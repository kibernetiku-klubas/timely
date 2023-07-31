<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">CREATE A</div>
            <div class="fill-current text-black text-4xl font-bold">NEW MEETING.</div>
        </div>
    </div>
    <body data-page-title="Create a meeting"></body>
    <x-slot name="header">
        <h2 class="text-xl text-black leading-tight">
            Create a meeting
        </h2>
    </x-slot>
    <x-meet-form-layout>
        <form method="POST" action="{{ route('meetings.store') }}">
            @csrf
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('TITLE')"/>
                <x-text-input id="title" class="block mt-1 w-full text-black" type="text" name="title"
                              :value="old('title')"
                              required autofocus autocomplete="title" maxlength="46" placeholder="Meeting Title"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>
            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('DESCRIPTION')"/>
                <x-textarea type="textarea" id="description" required autofocus autocomplete="description"
                            placeholder="Briefly describe what the meeting is about..." maxlength="1000"
                            name="description" class="text-black w-full">{{old('description')}}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>
            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('LOCATION')"/>
                <x-text-input id="location"
                              class="block mt-1 w-full text-black"
                              type="text" name="location" :value="old('location')" required autofocus
                              autocomplete="location" placeholder="Meeting Location (e.g., Conference Room A, Online)"
                              maxlength="50"/>
                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
            </div>
            <!-- Timezone -->
            <div>
                <x-input-label for="timezone" :value="__('TIMEZONE')"/>
                <select name="timezone" id="timezone" type="string"
                        class="border border-gray-300 text-black rounded-lg w-full mt-1 bg-white text-md focus:border-purple-500 focus:purple-500">
                    <option selected disabled>Choose a timezone</option>
                    <option>(UTC) Dublin, Edinburgh, Lisbon, London</option>
                    <option>(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                    <option>(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                    <option>(UTC+03:00) Kaliningrad, Minsk</option>
                    <option>(UTC+04:00) Moscow, St. Petersburg, Volgograd</option>
                    <option>(UTC+05:00) Islamabad, Karachi</option>
                    <option>(UTC+06:00) Ekaterinburg</option>
                    <option>(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
                    <option>(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                    <option>(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                    <option>(UTC+10:00) Canberra, Melbourne, Sydney</option>
                    <option>(UTC+11:00) Solomon Is., New Caledonia</option>
                    <option>(UTC+12:00) Auckland, Wellington</option>
                    <option>(UTC+13:00) Samoa</option>
                    <option>(UTC-01:00) Cape Verde Is.</option>
                    <option>(UTC-02:00) Mid-Atlantic</option>
                    <option>(UTC-03:00) Greenland</option>
                    <option>(UTC-04:00) Georgetown, La Paz, Manaus, San Juan</option>
                    <option>(UTC-05:00) Eastern Time (US & Canada)</option>
                    <option>(UTC-06:00) Central Time (US & Canada)</option>
                    <option>(UTC-07:00) Mountain Time (US & Canada)</option>
                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                    <option>(UTC-09:00) Alaska</option>
                    <option>(UTC-10:00) Hawaii</option>
                    <option>(UTC-11:00) Coordinated Universal Time-11</option>
                    <option>(UTC-12:00) International Date Line West</option>
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
                              type="string" name="duration" :value="old('duration')" required autofocus
                              autocomplete="duration" placeholder="Estimated Meeting Duration"/>
                <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
            </div>
            <!-- Delete_after -->
            <div>
                <x-input-label for="delete_after" :value="__('DELETE AFTER (DAYS) FROM CREATION:')"/>
                <x-text-input type="integer" id="delete_after"
                              class="block mt-1 w-full border border-gray-300 bg-white p-2 text-black"
                              type="string" name="delete_after" :value="old('delete_after')" required autofocus
                              autocomplete="delete_after" placeholder="Choose time until deletion"/>
                <x-input-error :messages="$errors->get('delete_after')" class="mt-2"/>
            </div>
            <!-- Save meeting -->
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('dashboard') }}" tabindex="-1">
                    <x-secondary-button class="ml-4">
                        Cancel
                    </x-secondary-button>
                </a>
                <x-primary-button class="ml-4">
                    Create meeting
                </x-primary-button>
            </div>
        </form>
    </x-meet-form-layout>
</x-app-layout>

