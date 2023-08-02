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
            <div class="fill-current text-black text-4xl font-bold">MEETING.</div>
        </div>
    </div>

    <div class="flex flex-col items-center text-black">
        <div
            class="w-full max-w-5xl mt-6 px-6 py-4 bg-white shadow-xl rounded-lg mb-16">
            @include('meetings.meeting-info')


            <div class="flex justify-center text-xl mt-8 font-bold"> DATES AND TIMES FOR THE MEETING:</div>
            <div class="flex justify-center text-xl mt-8">
                @if($meeting->is1v1 == 1)
                    Note: This meeting is 1 on 1, so only one vote per date is allowed.
                @endif
            </div>

            <div>
                @if (Auth::check())
                    @include ('meetings.edit-times')
                @else
                    <div class="flex justify-center my-8">
                        @include('meetings.vote')
                    </div>
                @endif
            </div>

            <div class="flex justify-center items-center text-lg">
                All times are in "{{$meeting->timezone}}" timezone
            </div>

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

            <div class="my-4">
                @include('meetings.edit-meeting-buttons')
            </div>

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
