<head>
    <title>{{$meeting->title}} • Timely</title>
</head>
<x-app-layout>
    @if (session()->has('error'))
        <x-notification type="error" message="{{ session('error') }}"/>
    @endif
    @if(session()->has('success'))
        <x-notification type="success" message="{{ session()->get('success') }}"/>
    @endif
    <div class="flex flex-col sm:justify-center items-center py-8 sm:pt-0 bg-gray-100 text-black">
        <div
            class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-5xl mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden rounded-lg">
            @if (Auth::check())
                <details class="collapse bg-white shadow-xl mb-6">
                    <summary class="collapse-title text-xl font-medium">Click here to add times</summary>
                    <div class="collapse-content">
                        @include ('meetings.edit-times')
                    </div>
                </details>
            @endif
            <h2 class="text-xl text-gray-800 leading-tight">
                Meeting: {{ $meeting->title }}
            </h2>
            Description: {{ $meeting->description }}<br>
            Location: {{ $meeting->location }}<br>
            Timezone: {{ $meeting->timezone }}<br>
            Duration (min): {{ $meeting->duration }}<br>
            Meeting link: <a href="">https://domain.com/{{ $meeting->id }}</a><br>
            Created at: {{ $meeting->created_at }}<br>
            Updated at: {{ $meeting->updated_at }}<br>

            @php
                $hasVoted = session()->has('voted_' . $meeting->id);
            @endphp

            @if (!$hasVoted)
                <div class="text-right pr-16">
                    <button
                        class="btn btn-outline border-none text-black text-xl shadow-black shadow-2xl hover:shadow-none"
                        onclick="votesModal.showModal()">Vote on times
                    </button>
                </div>
            @else
                <div class="text-right pr-16">
                    <button class="btn btn-outline border-none text-black text-xl shadow-2xl" disabled="disabled">
                        You have already voted
                    </button>
                </div>
            @endif
            <dialog id="votesModal" class="modal">
                <form method="POST" action="{{ route('vote.store') }}" class="modal-box bg-white shadow-2xl">
                    <a class="btn btn-circle btn-outline mb-4" onclick="document.getElementById('votesModal').close();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                    <h3 class="font-bold text-lg text-black">Check every time you want to vote on and enter your name to
                        save your votes</h3>
                    <p class="py-4 text-black">Note: Name will be visible to everyone viewing this meeting.<br>
                        It is also recommended to use your real name so that meeting creator knows who voted.</p>
                    @if (count($meeting->dates) === 0)
                        <p class="text-red-700 text-xl font-bold flex justify-center mt-4">NO DATES AVAILABLE FOR
                            VOTING</p>
                    @endif
                    @if (count($meeting->dates) > 0)
                        <div>
                            <x-input-label for="voted_by" :value="__('Your name')"/>
                            <x-text-input id="voted_by" class="block mt-1 w-full text-black" type="text" name="voted_by"
                                          :value="old('voted_by')" required autofocus/>
                            <x-input-error :messages="$errors->get('votes')" class="mt-2 text-red-700"/>
                        </div>
                        @foreach($meeting->dates as $date)
                            <input type="hidden" name="date_ids[]" value="{{ $date->id }}">
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <span class="label-text text-lg text-black">Vote on: {{$date->date_and_time}}</span>
                                    <div class="shadow-xl">
                                        <input type="checkbox" name="votes[]" value="{{ $date->id }}"
                                               class="checkbox checkbox-lg checkbox-success">
                                    </div>
                                </label>
                            </div>
                        @endforeach
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit" class="ml-4">
                                {{ __('Save votes') }}
                            </x-primary-button>
                        </div>
                    @endif
                </form>
            </dialog>
            <div class="flex justify-center text-xl mt-8 font-bold"> DATES AND TIMES FOR THE MEETING:</div>
            @if($meeting->dates->isEmpty())
                <div class="flex justify-center items-center h-full mt-4">
                    <h2 class="text-lg text-black font-bold">NO DATES YET</h2>
                </div>
                @if(Auth::check())
                    <p class="flex justify-center items-center h-full text-md mt-1 text-black font-bold">Add dates by
                        using date selector above</p>
                @endif
            @endif
            @php
                $highestVoteCount = 0;
            @endphp

            @foreach($meeting->dates as $date)
                @php
                    $voteCount = $date->votes->count();
                    if ($voteCount > $highestVoteCount) {
                        $highestVoteCount = $voteCount;
                    }
                @endphp
            @endforeach
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
            @if (Auth::check() && $meeting->user_id == Auth::User()->id)
                <a href='/meeting/{{ $meeting->id }}/edit'>
                    <button class='btn btn-warning shadow-xl'>Edit meeting</button>
                </a>
                <a href='/meeting/{{ $meeting->id }}/delete'>
                    <button class='btn btn-error shadow-xl'>Delete meeting</button>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
<script>
    let openButton = document.getElementById('openDialog');
    let dialog = document.getElementById('dialog');
    let closeButton = document.getElementById('closeDialog');
    let overlay = document.getElementById('overlay');
    let deleteForm = document.getElementById('deleteForm');

    function openModal(event) {
        event.preventDefault();
        dialog.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }

    function closeModal() {
        dialog.classList.add('hidden');
        overlay.classList.add('hidden');
    }

    function confirmDelete() {
        deleteForm.submit();
    }
</script>
