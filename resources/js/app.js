 require('./bootstrap');

 window.Vue = require('vue');

 import VueRouter from 'vue-router'

 Vue.use(VueRouter) 

 const files = require.context('./', true, /\.vue$/i)
 files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


 const router = new VueRouter({
     mode: '',

     routes: [ ]
 })


 const app = new Vue({
     el: '#app',

     router,

 });
