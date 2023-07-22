<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meeting {{$meeting->title}}
        </h2>
    </x-slot>
    Description:
    {{$meeting->description}}<br>
    Location:
    {{$meeting->location}}<br>
    Timezone: {{$meeting->timezone}}<br>
    Duration: {{$meeting->duration}}<br>
    Meet times: {{$meeting->meet_times}}<br>
    Meeting link: <a href="">https://domain.com/{{$meeting->id}}</a>
</x-app-layout>

