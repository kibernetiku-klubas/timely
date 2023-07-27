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
                @include ('meetings.edit-times')
            @endif

            @include('meetings.meeting-info')

            @include('meetings.vote')

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

            @include('meetings.meeting-cards')

            @include('meetings.edit-meeting-buttons')

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
