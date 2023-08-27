@if($selectedDate)
    <button class="text-black flex justify-center hover:bg-gray-300 mt-2 btn btn-ghost shadow-xl" onclick="my_modal_2.showModal()">{{ __('meeting-cards.export') }}</button>
    <dialog id="my_modal_2" class="modal">
        <form method="dialog" class="modal-box bg-gray-100 text-black">
            <p class="py-4 ">{{ __('meeting-cards.cancelcalendar') }}</p>

            <div class="flex justify-center items-center mb-6">
                <div class="tooltip mb-2" data-tip="{{ __('meeting-info.data-tip') }}">
                    <a class="link" id="link" href="https://timely.lt/export/{{ $selectedDate->id }}/ics">https://timely.lt/export/{{ $selectedDate->id }}/ics</a>
                </div>
                <a id="copyLink" class="btn-ghost rounded-lg" data-meeting-id="{{ $meeting->id }}">
                    <svg width="30" height="30" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="copy" fill="#000000" transform="translate(85.333333, 42.666667)">
                                <path
                                    d="M341.333333,85.3333333 L341.333333,405.333333 L85.3333333,405.333333 L85.3333333,85.3333333 L341.333333,85.3333333 Z M298.666667,128 L128,128 L128,362.666667 L298.666667,362.666667 L298.666667,128 Z M234.666667,7.10542736e-15 L234.666667,42.6666667 L42.6666667,42.6666667 L42.6666667,298.666667 L1.42108547e-14,298.666667 L1.42108547e-14,7.10542736e-15 L234.666667,7.10542736e-15 Z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>
            <p class="py-4 ">{{ __('meeting-cards.calendartutorial') }}</p>

            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">

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
