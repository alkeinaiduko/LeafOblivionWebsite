/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import VueNumeric from 'vue-numeric'



require('./bootstrap');

window.Vue = require('vue');

// Register Element UI Components
Vue.use(ElementUI, { size: 'small', zIndex: 3000, locale });

// Vue Numeric
Vue.use(VueNumeric)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('car-dealership', require('./components/CarDealership.vue').default);
Vue.component('admin-dashboard', require('./components/admin/Dashboard.vue').default);
Vue.component('admin-admins', require('./components/admin/admins.vue').default);
Vue.component('admin-roles', require('./components/admin/PageRole.vue').default);
Vue.component('admin-car-dealer', require('./components/admin/CarDealer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
