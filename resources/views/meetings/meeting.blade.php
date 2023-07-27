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
                @include ('meetings.edit-times')
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

            <div class="text-right pr-16">
                <button class="btn btn-outline border-none text-black text-xl shadow-black shadow-2xl hover:shadow-none"
                        onclick="votesModal.showModal()">Vote on times
                </button>
            </div>
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
                    <p class="py-4 text-black">Note: Name will be visible to everyone viewing this meeting</p>

                    @if (count($dates) === 0)
                        <p class="text-red-700 text-xl font-bold flex justify-center mt-4">NO DATES AVAILABLE FOR
                            VOTING</p>
                    @endif
                    @if (count($dates) > 0)
                        <div>
                            <x-input-label for="voted_by" :value="__('Your name')"/>
                            <x-text-input id="voted_by" class="block mt-1 w-full text-black" type="text" name="voted_by"
                                          :value="old('voted_by')" required autofocus/>
                            <x-input-error :messages="$errors->get('votes')" class="mt-2 text-red-700"/>
                        </div>
                        @foreach($dates as $date)
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
            <ul class="m-6">
                @foreach($dates as $date)
                    <li class="my-6 shadow-2xl p-6 rounded-xl">
                        <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>

                        <div class="flex justify-center">
                            <div class="mx-6">
                                From: {{$date->date_and_time}}<br>
                                To: {{date("Y-m-d H:i", strtotime("$date->date_and_time + $meeting->duration minute")) }}
                                ,
                            </div>
                            <div class="mr-2 font-bold">
                                Votes:
                            </div>
                            <div class="tooltip" data-tip="Names of people who voted">
                                Number of votes
                            </div>
                        </div>
                        <div class="container flex justify-center">
                            <div class="inline-flex rounded-md shadow-sm">
                                <!--Update chosen date-->
                                @if (Auth::check() && $user->id == $meeting->user_id)
                                    <form method="POST" action="{{ route('dates.update', ['id' => $date->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                                        <x-input-label for="new_time" :value="__('Select new time:')"/>
                                        <div class="inline-flex">
                                            <x-flatpickr name='new_time' show-time :min-date="now()->addMinutes(30)"
                                                         :max-date="today()->addDays(90)" required/>
                                        </div>
                                        <br>
                                        <x-primary-button type="submit" class="link-button mt-2">
                                            Confirm
                                        </x-primary-button>
                                        @error('new_time')
                                        <p class="text-red-500 text-sm">{{ "The selected date already exists." }}</p>
                                        @enderror
                                        <!--Delete chosen date-->

                                    </form>
                                    <form method="POST" action="{{ route('dates.destroy', ['id' => $date->id]) }}"
                                          onsubmit="return confirm('Are you sure you wish to delete this date?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="mt-[76px] -ml-[135px]">
                                            Delete
                                        </x-primary-button>
                                    </form>
                                @endif
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
