
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('avatar-upload', require('./components/AvatarUpload.vue'));

// const FileIndex = require('./components/files/Index.vue');

// const routes = [
//     {
//         path: '/files',
//         name: 'files.index',
//         component: FileIndex
//     }
// ];
//
//
// const router = new VueRouter({
//     mode: 'history',
//     routes
// });

const app = new Vue({
    el: '#app',
    //router
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})