@if ($user->id == $meeting->user_id)
    <x-flatpickr::style />

    <form method="POST" action="{{ route('dates.store') }}">
        @csrf
        <!-- Meeting ID -->
        <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>
        <!-- New Date and Time  -->
        <div class="mt-4">
            <x-input-label for="new_time" :value="__('Select new time:')" />
            <x-flatpickr name='new_time' show-time :min-date="now()->addMinutes(30)" :max-date="today()->addDays(90)" required />
            <x-input-error :messages="$errors->get('new_time')" class="mt-2" />
        </div>
        <!-- Save -->
        <x-primary-button class="ml-4 mt-2">
            {{ __('Add time') }}
        </x-primary-button>
    </form>

    <x-flatpickr::script />
@endif
