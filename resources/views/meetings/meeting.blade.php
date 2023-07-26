<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center py-8 sm:pt-0 bg-gray-100 text-black">
        <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-5xl mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden rounded-lg">
            @if (Auth::check())
                @include ('meetings.edit-times')
            @endif
            <h2 class="text-xl text-gray-800 leading-tight">
                Meeting: {{$meeting->title}}
            </h2>
            Description:
            {{$meeting->description}}<br>
            Location:
            {{$meeting->location}}<br>
            Timezone: {{$meeting->timezone}}<br>
            Duration (min): {{$meeting->duration}}<br>
            Meeting link: <a href="">https://domain.com/{{$meeting->id}}</a><br>
            Created at: {{$meeting->created_at}}<br>
            Updated at: {{$meeting->updated_at}}<br>

            Dates and times for the meeting:

            <ul class="m-6">
                @foreach($dates as $date)
                    <li class="my-6 shadow-xl p-6 rounded-xl">
                        <input type='hidden' name='meeting_id' value='{{$meeting->id}}'>
                    From: {{$date->date_and_time}}<br>
                    To: {{date("Y-m-d H:i", strtotime("$date->date_and_time + $meeting->duration minute")) }},
                    
                    <div class="container">
                        <div class="inline-flex rounded-md shadow-sm">
                            <!--Update chosen date-->
                            @if ($user->id == $meeting->user_id)
                            <form method="POST" action="{{ route('dates.update', ['id' => $date->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                                <x-input-label for="new_time" :value="__('Select new time:')" />
                                <div class="inline-flex">
                                <x-flatpickr name='new_time' show-time :min-date="now()->addMinutes(30)" :max-date="today()->addDays(90)" required />
                                </div><br>
                                <x-primary-button type="submit" class="link-button mt-2">
                                    Confirm
                                </x-primary-button>
                                @error('new_time')
                                    <p class="text-red-500 text-sm">{{ "The selected date already exists." }}</p>
                                @enderror
                                <!--Delete chosen date-->
                                
                            </form>
                            <form method="POST" action="{{ route('dates.destroy', ['id' => $date->id]) }}" onsubmit="return confirm('Are you sure you wish to delete this date?');">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" class="mt-[76px] -ml-[135px]">
                                    Delete
                                </x-primary-button>
                            </form>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text text-lg text-black">Vote on this date:</span>
                                <div class="shadow-xl">
                                <input type="checkbox" checked="checked" class="checkbox checkbox-lg checkbox-success" />
                                </div>
                            </label>
                        </div>
                        </div>
                        votes:
                        <div class="tooltip" data-tip="Names of people who voted">
                            Number of votes
                        </div>
                    </li>
                @endforeach
            </ul>
            @if (Auth::check())
                @if ($meeting->user_id == Auth::User()->id)
                @endif
                <a href='/meeting/{{ $meeting->id }}/edit'>
                    <button class='btn btn-warning'>Edit meeting</button>
                </a>
                <a href='/meeting/{{ $meeting->id }}/delete'>
                    <button class='btn btn-error'>Delete meeting</button>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>