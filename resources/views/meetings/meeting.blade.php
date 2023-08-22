<x-app-layout>

    <body data-page-title="{{$meeting->title}}"></body>

    @if (session()->has('error'))
        <x-notification type="error" message="{{ session('error') }}"/>
    @endif

    @if(session()->has('success'))
        <x-notification type="success" message="{{ session()->get('success') }}"/>
    @endif

    <div class="flex flex-col sm:justify-center items-center mt-8">
        <div>
            <div class="fill-current text-black text-4xl font-bold">{{ __('meeting.meeting') }}</div>
        </div>
    </div>

    <div class="flex flex-col items-center text-black">
        <div
            class="w-full max-w-5xl mt-6 px-6 py-4 bg-white shadow-xl rounded-lg mb-16">
            @include('meetings.meeting-info')

            @if (!$hasDeadlinePassed)
            <div class="flex justify-center text-xl font-bold"> {{ __('meeting.dates') }}</div>
            <div class="flex justify-center text-xl mt-4">
                @if($is1v1)
                    {{ __('meeting.1v1') }}
                @endif
            </div>

            <div>
                    @if ($isUserCreator)
                        @include ('meetings.edit-times')
                    @else
                        <div class="flex justify-center my-8">
                            @include('meetings.vote')
                        </div>
                    @endif
            </div>
            @else
                <div class="flex justify-center text-xl font-bold">{{ __('meeting.afterdeadline') }}</div>
            @endif

            @if ($meeting->voting_deadline > 0)
            <div class="flex justify-center items-center text-lg">
                {{ __('meeting.votingdeadline') }} {{$votingDeadline}}
            </div>
            @endif
            <div class="flex justify-center items-center text-lg">
                {{ __('meeting.timesarein') }} "{{$meeting->timezone}}" {{ __('meeting.timezone') }}
            </div>

            <div class="flex justify-center my-8">
                @include('meetings.export-time')
            </div>

            @if($meeting->dates->isEmpty())
                <div class="flex justify-center items-center h-full">
                    <h2 class="text-lg text-black font-bold">{{ __('meeting.nodates') }}</h2>
                </div>
                @if($isUserCreator)
                    <p class="flex justify-center items-center h-full text-md mb-16 text-black font-bold">{{ __('meeting.adddates') }}</p>
                @endif
            @endif

            @include('meetings.meeting-cards')

            <div class="my-4">
                @include('meetings.edit-meeting-buttons')
            </div>

        </div>
    </div>
</x-app-layout>
