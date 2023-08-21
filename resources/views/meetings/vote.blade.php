<script>
    function adjustModalPosition() {
        const modal = document.getElementById('votesModal');
        const modalBox = modal.querySelector('.modal-box');

        const viewportHeight = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        const modalBoxHeight = modalBox.offsetHeight;

        if (modalBoxHeight > viewportHeight) {
            modalBox.style.top = '50px';
            modalBox.style.transform = 'translate(-50%, 0)';
        }
    }

    window.addEventListener('resize', adjustModalPosition);
    window.addEventListener('orientationchange', adjustModalPosition);
</script>

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
