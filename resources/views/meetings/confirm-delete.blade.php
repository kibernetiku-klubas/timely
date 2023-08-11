<x-app-layout>
    <body data-page-title="Confirm delete"></body>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('confirm-delete.delete') }}</div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('confirm-delete.meeting') }}</div>
        </div>
    </div>
    <x-meet-form-layout>
        <form method="POST" action='{{ route('meetings.delete', $id = $meeting->id) }}'>
            @csrf
            @method('delete')
            <h2 class='text-2xl text-black font-bold uppercase'>{{ $meeting->title }}</h2><br>
            <p class='text-red-700 uppercase'>{{ __('confirm-delete.confirm') }}</p><br>
            <input type='hidden' name='id' value='{{ $meeting->id }}'>

            <a href="/meetings/{{ $meeting->id}}/">
                <x-secondary-button>{{ __('confirm-delete.cancel') }}</x-secondary-button>
            </a>
            <x-danger-button>{{ __('confirm-delete.confirm-delete') }}</x-danger-button>
        </form>
    </x-meet-form-layout>
</x-app-layout>
