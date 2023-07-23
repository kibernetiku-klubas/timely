<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            Add a new meeting
        </h2>
    </x-slot>
    <x-meet-form-layout>
        <form method="POST" action="{{ route('meetings.store') }}">
            @csrf
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea type="textarea" id="description" required autofocus autocomplete="description" name="description">{{old('description')}}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm bg-white"  type="string" name="location" :value="old('location')" required autofocus autocomplete="location" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>
            <!-- Timezone -->
            <div>
                <x-input-label for="timezone_offset" :value="__('Timezone')" />
                <select name = "timezone_offset" id="timezone_offset" type="string" class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 bg-white">
                    <option selected disabled>Choose a timezone</option>
                    <option value="0">(UTC) Dublin, Edinburgh, Lisbon, London</option>
                    <option value="1">(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                    <option value="2">(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                    <option value="3">(UTC+03:00) Kaliningrad, Minsk</option>
                    <option value="4">(UTC+04:00) Moscow, St. Petersburg, Volgograd</option>
                    <option value="5">(UTC+05:00) Islamabad, Karachi</option>
                    <option value="6">(UTC+06:00) Ekaterinburg</option>
                    <option value="7">(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
                    <option value="8">(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                    <option value="9">(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                    <option value="10">(UTC+10:00) Canberra, Melbourne, Sydney</option>
                    <option value="11">(UTC+11:00) Solomon Is., New Caledonia</option>
                    <option value="12">(UTC+12:00) Auckland, Wellington</option>
                    <option value="13">(UTC+13:00) Samoa</option>
                    <option value="-1">(UTC-01:00) Cape Verde Is.</option>
                    <option value="-2">(UTC-02:00) Mid-Atlantic</option>
                    <option value="-3">(UTC-03:00) Greenland</option>
                    <option value="-4">(UTC-04:00) Georgetown, La Paz, Manaus, San Juan</option>
                    <option value="-5">(UTC-05:00) Eastern Time (US & Canada)</option>
                    <option value="-6">(UTC-06:00) Central Time (US & Canada)</option>
                    <option value="-7">(UTC-07:00) Mountain Time (US & Canada)</option>
                    <option value="-8">(UTC-08:00) Pacific Time (US & Canada)</option>
                    <option value="-9">(UTC-09:00) Alaska</option>
                    <option value="-10">(UTC-10:00) Hawaii</option>
                    <option value="-11">(UTC-11:00) Coordinated Universal Time-11</option>
                    <option value="-12">(UTC-12:00) International Date Line West</option>
                </select>
                @error('timezone_offset')
                    <p class="text-red-500 text-sm">{{ "Timezone must be selected." }}</p>
                @enderror
            </div>
            <!-- Duration -->
            <div>
                <x-input-label for="duration" :value="__('Duration (min):')" />
                <x-text-input type="smallInteger" id="duration" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm bg-white" type="string" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
            </div>
            <!-- Delete_after -->
            <div>
                <x-input-label for="delete_after" :value="__('Delete after (days):')" />
                <x-text-input type="integer" id="delete_after" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm bg-white" type="string" name="delete_after" :value="old('delete_after')" required autofocus autocomplete="delete_after" />
                <x-input-error :messages="$errors->get('delete_after')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </x-meet-form-layout>
</x-app-layout>

