@if($selectedDate)
    <button class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl" onclick="my_modal_2.showModal()">{{ __('meeting-cards.export') }}</button>
    <dialog id="my_modal_2" class="modal">
        <form method="dialog" class="modal-box bg-gray-100 text-black">
            <p class="py-4 ">{{ __('meeting-cards.cancelcalendar') }}</p>

            <!-- Download .ics file -->
            <a href="{{ route('export.ics', $selectedDate->id)}}"
                class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl">
                {{ __('meeting-cards.getics') }}
            </a>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endif
