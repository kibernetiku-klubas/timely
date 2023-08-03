import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function getUserTimezone() {
    return moment.tz.guess();
}

document.addEventListener('DOMContentLoaded', function () {
    const pageTitle = document.body.dataset.pageTitle;

    document.title = pageTitle ? `${pageTitle} • Timely` : 'Timely';

    const timezoneSelect = document.getElementById('timezone');
    const userTimezone = getUserTimezone();
    const defaultOption = timezoneSelect.querySelector('option[value="default"]');

    defaultOption.textContent = `Auto-select (${userTimezone})`;
    defaultOption.value = userTimezone;
});

