const NwsltrRegisterSuccessfulComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;

    this.btnClose;

    this.init();
};

NwsltrRegisterSuccessfulComponent.prototype = {
    init: function () {
        this.hide();

        this.btnClose = this.component.el.querySelector('button[name=btn-close]');
        this.initEvents();
    },
    initEvents: function() {
        this.btnClose.addEventListener('click', () => this.hide());
    },
    show: function() {
        this.component.el.classList.add('show');
        this.component.el.classList.remove('hide');
    },
    hide: function() {
        this.component.el.classList.add('hide');
        this.component.el.classList.remove('show');
    }
};

