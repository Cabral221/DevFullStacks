require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import Vuex from 'vuex';
import storedata from './store';
Vue.use(Vuex);
// import storedata from './store/store';
const store = new Vuex.Store(storedata);

Vue.component('comments', require('./components/comments.vue').default);

// global.store = store;
const app = new Vue({
    el: '#appComment',
    store,
    // components:{comment},
    // data:{
    //     comments:{},
    //     // id:1
    // },
    // props: {
    //     id: Number,
    //     type: String,
    //     author: String,
    //     comment: String
    // },
    // router,
    // render: h => h(App, {props:{ id:' id prop'}}),
    // mounted() {
    //     axios.get('/comments', {
    //         params: {
    //             id: this.id,
    //             type: 'Post',
    //         }
    //     }).then(response => {
    //         this.comments = response.data;
    //         // console.log(response.data);
    //         // console.log(this.comments);
    //     }).catch(function (error) {
    //         console.log(error);
    //     });
    // },
});
