import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// Mobiilse menüü script
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuToggle.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');
    });
});
// Logo spin effekt
document.addEventListener('DOMContentLoaded', function() {
    const link = document.querySelector('.spin-on-load');

    link.addEventListener('mouseenter', function() {
    this.style.animation = 'none'; 
    void this.offsetWidth;
    this.style.animation = 'spin-hover 1.5s ease-in-out 1'; 
    });
});
