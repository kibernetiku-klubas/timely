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
