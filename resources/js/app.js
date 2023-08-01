import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Function to get the user's timezone using Moment.js
function getUserTimezone() {
  return moment.tz.guess();
}

document.addEventListener('DOMContentLoaded', function() {
    // Gets the tab name from the page's data attribute (make sure to set this in your view files!)
    const pageTitle = document.body.dataset.pageTitle;
  
    // Sets the document title dynamically based on the tab name
    document.title = pageTitle ? `${pageTitle} • Timely` : 'Timely';
    
    // Gets the user's timezone when the page has fully loaded
  const timezoneSelect = document.getElementById('timezone');
  const userTimezone = getUserTimezone();
  const defaultOption = timezoneSelect.querySelector('option[value="default"]');
  
  // Replaces the default option with the user's timezone
  defaultOption.textContent = `Auto-select (${userTimezone})`;
  defaultOption.value = userTimezone;
  });