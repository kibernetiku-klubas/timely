<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center py-8 sm:pt-0 bg-gray-100 text-black">
        <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-5xl mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden rounded-lg">
@include ('meetings.edit-times')
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
    {{$date->date_and_time}},
        <div class="container">
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
    @if ($meeting->user_id == Auth::User()->id)
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
