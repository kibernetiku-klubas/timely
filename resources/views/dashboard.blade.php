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
</x-app-layout>
