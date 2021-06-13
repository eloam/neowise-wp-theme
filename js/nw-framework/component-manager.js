const ComponentManager = {};

ComponentManager.getById = function(componentId) {

    const selector = `.component[data-id="${componentId}"]`;
    const element = document.querySelector(selector);

    if (element) {
        return new Component(element);
    }

    return null;
}

ComponentManager.getByName = function(componentName) {

    const selector = `.component[data-name="${componentName}"]`;
    const components = [];

    document.querySelectorAll(selector).forEach(element => {
        components.push(new Component(element));
    });

    return components;
} 