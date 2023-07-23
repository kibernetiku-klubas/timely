<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Meeting {{$meeting->title}}
    </h2>
</x-slot>
Description:
{{$meeting->description}}<br>
Location:
{{$meeting->location}}<br>
Timezone offset (h): {{$meeting->timezone_offset}}<br>
Duration (min): {{$meeting->duration}}<br>
Meeting link: <a href="">https://domain.com/{{$meeting->id}}</a><br>
Created at: {{$meeting->created_at}}<br>
Updated at: {{$meeting->updated_at}}

@include ('meetings.edit-times')