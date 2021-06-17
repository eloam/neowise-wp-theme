const ComponentManager = {
    components: [],
    register: function(infos, component) {
        this.components.push({ infos: infos, component: component });
    },
    getInfos: function(id) {
        const selector = `.component[data-id="${id}"]`;
        const element = document.querySelector(selector);
    
        if (element) {
            return new ComponentInfo(element);
        }
    
        return null;
    },
    getById: function(id) {
        const item = this.components.find(item => item.infos.id === id);

        if (item) {
            return item.component;
        }
        return undefined;
    },
    getByName: function(name) {
        const items = this.components.filter(item => item.infos.name === name);
        return items.map(item => item.component);
    } 
};
