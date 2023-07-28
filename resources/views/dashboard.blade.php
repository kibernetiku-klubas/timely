<x-app-layout>
    <body data-page-title="Dashboard"></body>
    @if(session()->has('success'))
        <x-notification type="success" message="{{ session()->get('success') }}"/>
    @endif

    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">YOUR</div>
            <div class="fill-current text-black text-4xl font-bold mb-8">MEETINGS.</div>
        </div>
    </div>
    @if($meetings->isEmpty())
        <div class="flex justify-center items-center h-full">
            <h2 class="text-2xl text-black font-bold">NO MEETINGS YET</h2>
        </div>
        <p class="flex justify-center items-center h-full text-xl mt-1 text-black font-bold">Create your first meeting
            by pressing "Create a meeting" button</p>
    @endif
    <div class="flex justify-center">
        <div
            class="card-container grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mx-2 sm:mx-4 md:mx-8">
            @foreach ($meetings as $meeting)
                <a href='/meetings/{{ $meeting->id }}' class="flex items-center justify-center h-full">
                    <div class="card bg-white hover:bg-gray-200 shadow-xl w-full h-full hover:shadow-lg rounded-lg p-4">
                        <div class="card-body">
                            <h2 class="card-title text-xl sm:text-2xl md:text-base lg:text-xl text-black">
                                {{ $meeting->title }}
                            </h2>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-8 mr-4 md:mr-8 flex justify-end">
        {{ $meetings->links() }}
    </div>
</x-app-layout>
