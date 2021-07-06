

require('./bootstrap');

window.Vue = require('vue').default;





Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('task-component', require('./components/TaskComponent.vue').default);


const app = new Vue({
    el: '#app',
});
