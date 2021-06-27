const HeaderMenuComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;

    this.menu = null;
    this.navMain = null;

    this.menuStates = { open: 'open', closed: 'closed' };

    this.init();
};

HeaderMenuComponent.prototype = {

    init: function() {
        this.buttonMobileMenu = document.getElementById('button-mobile-menu');
        this.mobileMenu = document.getElementById('mobile-menu');

        this.registerMenuBarsClickEvent();
    },

    registerMenuBarsClickEvent: function() {

        const self = this;

        this.buttonMobileMenu.addEventListener('click', (e) => {
            // Gestion de l'ARIA
            this.buttonMobileMenu.ariaExpanded = this.buttonMobileMenu.ariaExpanded === 'true' ? 'false' : 'true';

            // On alterne l'icone du bouton menu (en mobile)
            this.buttonMobileMenu.querySelectorAll('svg').forEach(item => {
                item.classList.toggle('block');
                item.classList.toggle('hidden');
                // Gestion de l'ARIA
                item.ariaHidden = item.ariaHidden === 'true' ? 'false' : 'true';
            });

            // On affiche/masque le menu mobile
            this.mobileMenu.classList.toggle('block');
            this.mobileMenu.classList.toggle('hidden');
        });
    }

}