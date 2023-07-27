<ul class="m-6">
    @foreach($meeting->dates as $date)
        <li class="my-6 shadow-2xl p-6 rounded-xl">
            @if($date->votes->count() > 0 && $date->votes->count() === $highestVoteCount)
                <div class="badge shadow-xl badge-outline">Most voted</div>
            @endif
            <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>
            <div class="container flex justify-end">
                <div class="inline-flex rounded-md shadow-sm">
                    <!-- Update chosen date -->
                    @if (Auth::check())
                        @if ($user->id == $meeting->user_id)
                            <!-- Delete chosen date -->
                            <form id="deleteForm" method="POST"
                                  action="{{ route('dates.destroy', ['id' => $date->id]) }}">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <label tabindex="0"
                                           class="btn m-1 bg-white rounded-full border-none hover:bg-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="black" class="bi bi-three-dots"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                        </svg>
                                    </label>
                                    <ul tabindex="0"
                                        class="dropdown-content menu shadow-xl bg-white rounded-box p-4 hover:bg-gray-200">
                                        <a id="openDialog" class=""
                                           onclick="openModal(event)">
                                            Delete
                                        </a>
                                    </ul>
                                </div>
                            </form>
                            <div id="overlay"
                                 class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
                            <div id="dialog"
                                 class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
                                <h1 class="text-2xl font-semibold">Confirm Deletion</h1>
                                <div class="py-5 border-t border-b border-gray-300">
                                    <p>Are you sure you want to delete this date?</p>
                                </div>
                                <div class="flex justify-end">
                                    <x-primary-button id="closeDialog" onclick="closeModal()">
                                        Cancel
                                    </x-primary-button>
                                    <buttom id="confirmDelete" class="ml-2 btn btn-error"
                                            onclick="confirmDelete()">
                                        Confirm Delete
                                    </buttom>
                                </div>
                            </div>
                        @endif

                    @endif
                </div>
            </div>
            <div class="flex justify-center">
                <div class="mx-6">
                    From: {{$date->date_and_time}}<br>
                    To: {{date("Y-m-d H:i", strtotime("$date->date_and_time + $meeting->duration minute")) }}
                    ,
                </div>
                <div class="mr-2 font-bold text-xl">
                    Votes:
                </div>
                <div class="w-60">
                    <details class="collapse collapse-arrow bg-white shadow-xl hover:bg-gray-300">
                        <summary
                            class="collapse-title text-xl font-medium">{{ $date->votes->count() }}</summary>
                        <div class="collapse-content">
                            @if($date->votes->isEmpty())
                                <div class="font-bold">No votes on this date</div>
                            @else
                                <div class="font-bold">People who voted:<br></div>
                                @foreach($date->votes as $vote)
                                    {{ $vote->voted_by }}<br>
                                @endforeach
                            @endif
                        </div>
                    </details>
                </div>
            </div>
        </li>
    @endforeach
</ul>
