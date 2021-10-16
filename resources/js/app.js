require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes';
//import a class for globel used
import Notification from './Helpers/Notification';
window.Notification = Notification;
//for sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;
///vue js modal
import VModal from "vue-js-modal";
window.VModal = VModal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;
window.Reload = new Vue();
Vue.use(VueRouter)
const router = new VueRouter({
        routes,
        mode: 'history'
    })
    // Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});