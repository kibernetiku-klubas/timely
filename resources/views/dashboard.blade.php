<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center justify-center">
        <a href="/add-meeting"><button class="btn btn-outline">Add a new meeting</button></a>
        </div>
    </div>
    
    <div class="card-container grid grid-cols-1 gap-4 place-items-center md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
    @foreach ($meetings as $meeting)
        <div class="card w-96 bg-primary-content shadow-x1 card-bordered">
            <div class="card-body">
                <h2 class="card-title text-base-200">{{ $meeting->title }}</h2>
                <p class="text-base-100">{{ $meeting->description }}</p>
                <div class="card-actions justify-end">
                    <a href='/meetings/{{ $meeting->id }}'>
                        <button class="btn btn-primary">View</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</x-app-layout>
