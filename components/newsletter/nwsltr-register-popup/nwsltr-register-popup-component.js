const NwsltrRegisterPopupComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;
    this.currentState = 'pending';

    this.btnCancel;
    this.btnOk;

    this.init();
    this.showPending();
};

NwsltrRegisterPopupComponent.prototype = {
    init: function () {
        this.btnCancel = this.component.el.querySelector('button.cancel-action');
        this.btnOk = this.component.el.querySelector('button.ok-action');

        this.initEvents();
    },
    initEvents: function() {

        this.btnCancel.addEventListener('click', () => this.hide());

        this.btnOk.addEventListener('click', () => { 
            if (this.currentState === 'error') {
                const w = 600;
                const h = 400;
                const top = Number((screen.height/2)-(h/2));
                const left = Number((screen.width/2)-(w/2));
        
                window.open(this.data.urlFormSignup, 'popup', `width=${w}, height=${h}, top=${top}, left=${left}`); 
            }

            this.hide();
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                if (this.currentState === 'succeed' || this.currentState === 'error') { 
                    this.btnOk.click();  
                    e.preventDefault();
                }
            }

            if (e.key === 'Escape' && (this.currentState === 'succeed' || this.currentState === 'error')) {
                this.hide();
                e.preventDefault();
            }
        });
    },
    show: function() {
        this.component.el.classList.add('show');
        this.component.el.classList.remove('hide');
    },
    hide: function() {
        this.currentState = 'pending';
        this.component.el.classList.add('hide');
        this.component.el.classList.remove('show');
    },
    showPending: function() {
        this.currentState = 'pending';
        this.component.el.querySelectorAll('.subscription-state-pending').forEach(item => item.style.display = '');
        this.component.el.querySelectorAll('.subscription-state-succeed, .subscription-state-error').forEach(item => item.style.display = 'none');

        this.btnCancel.style.display = 'none';
        this.btnOk.style.display = 'none';
    },
    showSucceed: function() {
        this.currentState = 'succeed';
        this.component.el.querySelectorAll('.subscription-state-succeed').forEach(item => item.style.display = '');
        this.component.el.querySelectorAll('.subscription-state-pending, .subscription-state-error').forEach(item => item.style.display = 'none');

        this.btnCancel.style.display = 'none';
        this.btnOk.style.display = '';
    },
    showError: function() {
        this.currentState = 'error';
        this.component.el.querySelectorAll('.subscription-state-error').forEach(item => item.style.display = '');
        this.component.el.querySelectorAll('.subscription-state-succeed, .subscription-state-pending').forEach(item => item.style.display = 'none');

        this.btnCancel.style.display = '';
        this.btnOk.style.display = '';
    }
};

