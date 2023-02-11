import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Vue.component(
    "auto-complete-datalist-component",
    require("./components/AutoCompleteDatalistComponent.vue").default
);