require('./bootstrap');

require('alpinejs');

require('vue');

import Vue from 'vue';
import connect from './components/Connect.vue';



const app = new Vue({
    el: '#app',
    components: {
        connect
    },
    created() {
        console.log('ccreated')
    }
});

console.log('one');

