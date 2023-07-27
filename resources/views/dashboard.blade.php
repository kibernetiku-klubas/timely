<x-app-layout>
    @if(session()->has('success'))
        <x-notification type="success" message="{{ session()->get('success') }}" />
    @endif

    <div class="py-12">
        <div class="flex items-center justify-center">
        <a href="/add-meeting"><button class="btn btn-outline border-none bg-primary-content text-black text-xl shadow-xl p-8 content-center">Add a new meeting <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg></button></a>
        </div>
    </div>

    <div class="flex justify-center text-3xl text-black mb-12 font-bold">Your meetings</div>
    <div class="flex justify-center">
        <div class="card-container grid grid-cols-1 gap-5 place-items-center md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 mx-14">
            @foreach ($meetings as $meeting)
                <div class="card bg-primary-content shadow-xl w-full sm:w-full md:w-96 h-full">
                    <div class="card-body">
                        <h2 class="card-title text-base-200">{{ $meeting->title }}</h2>
                        <div class="card-actions justify-end">
                            <a href='/meetings/{{ $meeting->id }}'>
                                <button class="btn btn-outline border-none text-black text-xl shadow-xl hover:shadow-gray-400">View</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
