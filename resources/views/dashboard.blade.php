<x-app-layout>
    <body data-page-title="Dashboard"></body>
    @if (session()->has('error'))
        <x-notification type="error" message="{{ session('error') }}"/>
    @endif

    @if(session()->has('success'))
        <x-notification type="success" message="{{ session()->get('success') }}"/>
    @endif

    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold uppercase">{{ __('dashboard.your') }}</div>
            <div class="fill-current text-black text-4xl font-bold uppercase mb-8">{{ __('dashboard.meetings') }}.</div>
        </div>
    </div>
    @if($meetings->isEmpty())
        <div class="flex justify-center items-center h-full">
            <h2 class="text-2xl text-black font-bold uppercase">{{ __('dashboard.nomeetingsyet') }}</h2>
        </div>
        <p class="flex justify-center items-center h-full text-xl mt-1 text-black font-bold px-6">{{ __('dashboard.createfirstmeet') }}</p>
    @endif
    <div class="flex justify-center">
        <div
            class="card-container grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mx-2 sm:mx-4 md:mx-8">
            @foreach ($meetings as $meeting)
                    <x-meeting-card :meeting="$meeting" />
            @endforeach
        </div>
    </div>

    <div class="mt-8 mr-4 md:mr-8 flex justify-end">
        {{ $meetings->links() }}
    </div>
</x-app-layout>
