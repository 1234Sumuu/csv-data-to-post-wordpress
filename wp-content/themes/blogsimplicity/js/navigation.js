document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.main-navigation');

    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('toggled');
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !expanded);
        });
    }

    // Ensure the sub-menus are accessible using the keyboard
    const subMenuToggles = navMenu.querySelectorAll('.menu-item-has-children > a');
    subMenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            const parentMenuItem = toggle.parentElement;
            parentMenuItem.classList.toggle('open');
            const expanded = toggle.getAttribute('aria-expanded') === 'true' || false;
            toggle.setAttribute('aria-expanded', !expanded);
        });

        toggle.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                const parentMenuItem = toggle.parentElement;
                parentMenuItem.classList.toggle('open');
                const expanded = toggle.getAttribute('aria-expanded') === 'true' || false;
                toggle.setAttribute('aria-expanded', !expanded);
            }
        });
    });

    // Ensure the mobile menu button is focusable
    const menuItems = navMenu.querySelectorAll('a');
    menuItems.forEach(item => {
        item.addEventListener('focus', function() {
            navMenu.classList.add('focused');
        });
        item.addEventListener('blur', function() {
            navMenu.classList.remove('focused');
        });
    });
});
