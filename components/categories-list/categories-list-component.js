const CategoriesListComponent = function (instance, viewData) {
    this.component = instance;
    this.data = viewData;
    this.init();
};

CategoriesListComponent.prototype = {
    init: function () {
        const self = this;
    
        window.addEventListener('DOMContentLoaded', function() {
            self.applyMarginLeftComponent();
            self.applyScrollButtonsEvent();
        });
    
        window.addEventListener('resize', function () {
            self.applyMarginLeftComponent();
            self.applyVisibilityScrollButtons();
        });
    },
    
    applyMarginLeftComponent: function () {

        const fakeContainer = this.component.el.querySelector('.calc-margin');

        if (!fakeContainer) { return; }

        const fakeContainerComputedStyle = window.getComputedStyle(fakeContainer);

        const marginLeft = parseInt(fakeContainerComputedStyle.marginLeft);
        const paddingLeft = parseInt(fakeContainerComputedStyle.paddingLeft);

        const wrapper = this.component.el.querySelector('.overflow-wrapper');

        if (!wrapper) { return; }

        wrapper.style.paddingLeft = (marginLeft + paddingLeft) + 'px';
    },

    applyScrollButtonsEvent: function () {
    
        const self = this;

        const wrapper = this.component.el.querySelector('.overflow-wrapper');

        const leftScrollBtn = this.component.el.querySelector('.button-scroll.left');
        leftScrollBtn.addEventListener('click', function() {
            let scrollValue = wrapper.offsetWidth / 2;
            EasingFunctions.animate(EasingFunctions.easeInOutCubic, 1500, function(completionValue) {
                const assignScrollValue = scrollValue * completionValue;
                scrollValue -= assignScrollValue;
        
                wrapper.scrollLeft -= assignScrollValue;

                self.applyVisibilityScrollButtons();
            });
        });

        const rightScrollBtn = this.component.el.querySelector('.button-scroll.right');
        rightScrollBtn.addEventListener('click', function () {
            let scrollValue = wrapper.offsetWidth / 2;
            EasingFunctions.animate(EasingFunctions.easeInOutCubic, 1500, function(completionValue) {
                const assignScrollValue = scrollValue * completionValue;
                scrollValue -= assignScrollValue;
        
                wrapper.scrollLeft += assignScrollValue;

                self.applyVisibilityScrollButtons();
            });
        });

        this.applyVisibilityScrollButtons();
    },

    applyVisibilityScrollButtons: function () {

        const wrapper = this.component.el.querySelector('.overflow-wrapper');
        const leftScrollBtn = this.component.el.querySelector('.button-scroll.left');
        const rightScrollBtn = this.component.el.querySelector('.button-scroll.right');

        if (wrapper.scrollWidth <= wrapper.offsetWidth) { 
            if (leftScrollBtn.style.display !== 'none') leftScrollBtn.style.display = 'none';
            if (rightScrollBtn.style.display !== 'none') rightScrollBtn.style.display = 'none';
        } else {
            if (wrapper.scrollLeft === 0) {
                if (leftScrollBtn.style.display !== 'none') leftScrollBtn.style.display = 'none';
                if (rightScrollBtn.style.display === 'none') rightScrollBtn.style.display = '';
            } else if (Math.round(wrapper.scrollLeft) >= wrapper.scrollWidth - wrapper.offsetWidth) {
                if (leftScrollBtn.style.display === 'none') leftScrollBtn.style.display = '';
                if (rightScrollBtn.style.display !== 'none') rightScrollBtn.style.display = 'none';
            } else {
                if (leftScrollBtn.style.display === 'none') leftScrollBtn.style.display = '';
                if (rightScrollBtn.style.display === 'none') rightScrollBtn.style.display = '';
            }
        }
    }
};


