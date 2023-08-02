@foreach($datesGroupedByYear as $year => $dates)
    <div class="text-center mt-8 mb-4">
        <div class="divider">
            <h1 class="text-3xl font-bold">{{ $year }}</h1>
        </div>
    </div>
    <ul class="grid lg:grid-cols-3 sm:grid-cols-1 md:grid-cols-2 gap-2">
        @foreach($dates as $date)
            <li class="p-6 shadow-xl rounded-lg">

                <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>
                <div class="flex justify-between">
                    @if($date->votes->count() > 0 && $date->votes->count() === $highestVoteCount)
                        <div class="badge badge-outline text-purple-500 outline-purple-500 mt-3">Most voted</div>
                    @else
                        <div class="badge badge-outline outline-none border-none mt-3"></div>

                    @endif
                    <!-- Update chosen date -->
                    @if (Auth::check() && $user->id == $meeting->user_id)
                        <form id="deleteForm" method="POST" action="{{ route('dates.destroy', ['id' => $date->id]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="dropdown">
                                <label tabindex="0" class="btn m-1 bg-white rounded-full border-none hover:bg-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                         class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </label>
                                <a id="openDialog" class="" onclick="openModal(event)">
                                    <ul tabindex="0"
                                        class="dropdown-content bg-gray-100 rounded-box p-4 hover:bg-gray-200">
                                        Delete
                                    </ul>
                                </a>
                            </div>
                        </form>
                        <div id="overlay"
                             class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
                        <div id="dialog"
                             class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
                            <h1 class="text-2xl font-bold uppercase">Confirm Deletion.</h1>
                            <p class="text-red-700">Are you sure you want to delete this date?</p>
                            <div class="flex justify-end">
                                <x-secondary-button class="m-1" id="closeDialog" onclick="closeModal()">Cancel
                                </x-secondary-button>
                                <x-danger-button class="m-1" onclick="confirmDelete()">Confirm
                                    Delete
                                </x-danger-button>
                            </div>
                        </div>
                    @endif
                </div>

                @php
                    $formattedDate = date("M d", strtotime($date->date_and_time));
                    $endTime = $date->date_and_time->copy()->addMinutes($meeting->duration);
                @endphp

                <div class="flex justify-center">
                    <div>
                        <div class="text-4xl font-bold">{{ $formattedDate }}</div>
                        <div class="font-bold uppercase"><span
                                class="text-5xl font-bold">{{ $date->date_and_time->format('H:i') }}</span></div>
                        <div class="font-bold uppercase"><span class="text-5xl">{{ $endTime->format('H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="font-bold text-xl flex justify-center mt-4"></div>
                <div class="flex justify-center text-black text-3xl font-bold">Votes: {{ $date->votes->count() }}</div>
                <div class="flex justify-center">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <details class="collapse collapse-arrow bg-white hover:bg-gray-300 my-2 md:my-0 md:w-1/2">
                            <summary class="collapse-title text-md font-bold">CLICK TO SEE WHO VOTED</summary>
                            <div class="collapse-content px-4 md:px-6">
                                @if($date->votes->isEmpty())
                                    <div class="font-bold">NO VOTES ON THIS DATE</div>
                                @else
                                    <div class="font-bold mb-2 md:mb-4">PEOPLE WHO VOTED:</div>
                                    @foreach($date->votes as $vote)
                                        <div class="mb-1">{{ $vote->voted_by }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </details>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endforeach
