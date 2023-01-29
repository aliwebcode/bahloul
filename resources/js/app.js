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

// /* Multi Languages */
// require('lang.js');
// import VueLang from '@eli5/vue-lang-js'
// // get the data source
// import translations from './lang/words';
// // import messages from "./lang/en"
// Vue.use(VueLang, {
//     messages: translations, // Provide locale file
//     // locale: 'en', // Set locale
//     fallback: ['ar', 'es'] // Set fallback locale
// });


const app = new Vue({
    el: '#app',
    router: routes,
    data: function () {
        return {
            settings: []
        }
    },
    mounted() {
        axios.get('/request/get-settings')
            .then((res) => {
                this.settings = res.data
            })
        if(authUser) {
            // Listen to notification
            Echo.private(`App.User.${authUser.id}`)
                .notification((notification) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: true,
                        timerProgressBar: false,
                        showCloseButton: true,
                    })
                    Toast.fire({
                        icon: 'info',
                        title: notification.data.candidate.name + ' Applied ' + notification.data.job.title + ' Job'
                    })
                });
        }
    }
});
