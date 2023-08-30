@if ($meeting->custom_url)
    <a href='/{{ $meeting->custom_url }}' class="flex items-center justify-center h-full">
        @else
            <a href='/meetings/{{ $meeting->id }}' class="flex items-center justify-center h-full">
                @endif
                <div class="card bg-white hover:bg-gray-200 shadow-xl w-full h-full hover:shadow-lg rounded-lg p-4">
                    <div class="card-body">
                        <h2 class="card-title text-xl sm:text-2xl md:text-base lg:text-xl text-black">
                            {{ Str::limit($meeting->title, 25) }}
                        </h2>
                    </div>
                </div>
            </a>
    </a>
