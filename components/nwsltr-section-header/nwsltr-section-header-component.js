const NwsltrSectionHeaderComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;
    this.init();
};

NwsltrSectionHeaderComponent.prototype = {
    init: function () {

        const self = this;
    
        window.addEventListener('DOMContentLoaded', function() {
            self.changeNwsltrButtonValue();
            self.signUpToNwsltrOnClickEvent();
        });
    
        window.addEventListener('resize', function() {
            self.changeNwsltrButtonValue();
        });
    },
    
    changeNwsltrButtonValue: function() {
        
        const nwsltrSubmitBtn = this.component.el.querySelector('.nwsltr-header-signup .input-button');
    
        if (!nwsltrSubmitBtn) { return; }
    
        if (window.innerWidth < 576 && nwsltrSubmitBtn.value !== nwsltrSubmitBtn.dataset.altValue) {
            nwsltrSubmitBtn.value = nwsltrSubmitBtn.dataset.altValue;
        } else if(window.innerWidth >= 576 && nwsltrSubmitBtn.value !== nwsltrSubmitBtn.dataset.value) {
            nwsltrSubmitBtn.value = nwsltrSubmitBtn.dataset.value;
        }
    
    },
    
    signUpToNwsltrOnClickEvent: function() {
        
        const self = this;
        const form = this.component.el.querySelector('.nwsltr-header-signup');
    
        if (!form) { return; }
    
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
    
            const request = new XMLHttpRequest();
            request.open("POST", ajaxurl, true);

            request.onload = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    self.displaySuccessMessage();
                } else {
                    self.displayFailMessage();
                }
            }

            request.send(formData);
        });
    },
    
    displaySuccessMessage: function() {
    
        const defaultMessagePanel = this.component.el.querySelector('.default-message');
        const successMessagePanel = this.component.el.querySelector('.success-message');
    
        if (defaultMessagePanel) {
            defaultMessagePanel.style.display = 'none';
        }
    
        if (successMessagePanel) {
            successMessagePanel.style.display = '';
        }
    
    },
    
    displayFailMessage: function() {
        
        const defaultMessagePanel = this.component.el.querySelector('.default-message');
        const failMessagePanel = this.component.el.querySelector('.fail-message');
    
        if (defaultMessagePanel) {
            defaultMessagePanel.style.display = 'none';
        }
    
        if (failMessagePanel) {
            failMessagePanel.style.display = '';
        }
    }
};

