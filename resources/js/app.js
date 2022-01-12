require('./bootstrap');

import Vue from 'vue'
import routes from "./router";

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

import VueModal from '@kouts/vue-modal'
import '@kouts/vue-modal/dist/vue-modal.css'
Vue.component('Modal', VueModal)

import pagination from 'laravel-vue-pagination'
Vue.component('pagination',pagination)

const app = new Vue({
    el: '#app',
    router: routes
});
