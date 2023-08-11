<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold uppercase"><h1>{{ __('edit.profile') }}</h1></div>
        </div>
    </div>
    <body data-page-title={{ __('edit.profile_tab') }}></body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('edit.profile') }}
        </h2>
    </x-slot>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
