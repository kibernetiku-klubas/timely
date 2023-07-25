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
Updated at: {{$meeting->updated_at}}

Dates and times for the meeting:

<ul>
@foreach($dates as $date)
    <li>
    {{$date->date_and_time}}, votes: {{$date->voted_by}}
    </li>
@endforeach
</ul>
