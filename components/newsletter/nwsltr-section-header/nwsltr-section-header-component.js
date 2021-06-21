const NwsltrSectionHeaderComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;
    this.init();
};

NwsltrSectionHeaderComponent.prototype = {
    init: function () {

        const self = this;
    
        window.addEventListener('DOMContentLoaded', function() {
            self.signUpToNwsltrOnClickEvent();
        });
    },
    
    signUpToNwsltrOnClickEvent: function() {
        
        const self = this;
        const form = this.component.el.querySelector('.nwsltr-header-signup');

        const popupComponent = ComponentManager.getById(this.data.popupComponentId);
    
        if (!form) { return; }
    
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            popupComponent.showPending();
            popupComponent.show();

            const formData = new FormData(this);
    
            const request = new XMLHttpRequest();
            request.open("POST", ajaxurl, true);

            request.onload = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    try {
                        response = JSON.parse(this.response);
                        if (response.success) {
                            self.displaySuccessMessage();
                        } else {
                            self.displayErrorMessage();
                        }
                    } catch (error) {
                        self.displayErrorMessage();
                    }
                } else {
                    self.displayErrorMessage();
                }
            }

            request.send(formData);
        });
    },
    
    displaySuccessMessage: function() {
        const popupComponent = ComponentManager.getById(this.data.popupComponentId);
        popupComponent.showSucceed();
    },
    
    displayErrorMessage: function() {
        const popupErrorComponent = ComponentManager.getById(this.data.popupComponentId);
        popupErrorComponent.showError();
    }
};

