@vite(['resources/js/votes-modal.js'])

@php
    $isDisabledBtnClass = $hasVoted ? 'shadow-2xl' : 'shadow-lg hover:shadow-none';
    $btnClickHandler = $hasVoted ? '' : 'onclick="votesModal.showModal()"';
    $disabledAttribute = $hasVoted ? 'disabled="disabled"' : '';
    $buttonText = $hasVoted ? __('vote.havevoted') : __('vote.addvotes');
@endphp

<button
    class="btn btn-outline border-none text-black text-xl {{ $isDisabledBtnClass }}"
    {!! $btnClickHandler !!}
    {!! $disabledAttribute !!}
>
    <div class="text-gray-700">{{ $buttonText }}</div>
</button>

<x-votes-modal :meeting="$meeting"/>
