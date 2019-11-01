require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import Vuex from 'vuex';
import storedata from './store';
Vue.use(Vuex);
// import storedata from './store/store';
const store = new Vuex.Store(storedata);

Vue.component('comments', require('./components/comments.vue').default);

require('./css/animation.css')

global.store = store;
const app = new Vue({
    el: '#appComment',
    store,
});
