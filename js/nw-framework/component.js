const Component = function (element) {

    this.id = element.dataset.id;
    this.name = element.dataset.name; 
    this.el = element;
};