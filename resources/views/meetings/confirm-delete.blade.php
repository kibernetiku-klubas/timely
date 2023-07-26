<x-app-layout>
    <x-meet-form-layout>
        <form method="POST" action='{{ route('meetings.delete', $id = $meeting->id) }}'>
            @csrf
            @method('delete')
            <h2 class='text-xl text-base-200'>{{ $meeting->title }}</h2><br>
            <p class='text-base-200'>Are you sure you'd like to remove this meeting?</p><br>
            <input type='hidden' name='id' value='{{ $meeting->id }}'>
            <x-primary-button class='btn btn-outline btn-error'>Confirm deletion</x-primary-button>
        </form>
    </x-meet-form-layout>
</x-app-layout>