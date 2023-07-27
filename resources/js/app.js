import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    // Get the tab name from the page's data attribute (make sure to set this in your view files)
    const pageTitle = document.body.dataset.pageTitle;
  
    // Set the document title dynamically based on the tab name
    document.title = pageTitle ? `${pageTitle} • Timely` : 'Timely';
  });