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
        this.menu = this.component.el.querySelector('.menu-bars');
        this.navMain = this.component.el.querySelector('.nav-main');

        this.registerMenuBarsClickEvent();
    },

    registerMenuBarsClickEvent: function() {

        const self = this;

        this.menu.dataset.state = this.menuStates.closed;

        this.menu.addEventListener('click', function () {
            if (self.menu.dataset.state === self.menuStates.closed) {
                self.navMain.classList.add('show-menu');
                self.menu.querySelector('i.fal').classList.replace('fa-bars', 'fa-times');
                self.component.el.classList.add('fullscreen-menu');
                self.menu.dataset.state = self.menuStates.open;
            } else {
                self.navMain.classList.remove('show-menu');
                self.menu.querySelector('i.fal').classList.replace('fa-times', 'fa-bars');
                self.component.el.classList.remove('fullscreen-menu');
                self.menu.dataset.state = self.menuStates.closed;
            }
        });
    }

}