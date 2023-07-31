<x-app-layout>
    <body data-page-title="Confirm delete"></body>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">DELETE</div>
            <div class="fill-current text-black text-4xl font-bold">MEETING.</div>
        </div>
    </div>
    <x-meet-form-layout>
        <form method="POST" action='{{ route('meetings.delete', $id = $meeting->id) }}'>
            @csrf
            @method('delete')
            <h2 class='text-2xl text-black font-bold uppercase'>{{ $meeting->title }}</h2><br>
            <p class='text-red-700 uppercase'>Are you sure you want to delete this meeting?</p><br>
            <input type='hidden' name='id' value='{{ $meeting->id }}'>

            <a href="/meetings/{{ $meeting->id}}/">
                <x-secondary-button>Cancel</x-secondary-button>
            </a>
            <x-danger-button>Confirm deletion</x-danger-button>
        </form>
    </x-meet-form-layout>
</x-app-layout>
