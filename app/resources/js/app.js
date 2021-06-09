require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import { BootstrapVue} from 'bootstrap-vue'

Vue.use(BootstrapVue)

Vue.component('v-header', require('./components/header.vue').default);

Vue.component('v-buhta', require('./components/buhta.vue').default);
Vue.component('v-types', require('./components/types.vue').default);
Vue.component('v-Warehouse', require('./components/Warehouse.vue').default);
Vue.component('v-thicknesse', require('./components/thicknesse.vue').default);
Vue.component('v-counterparties', require('./components/counterparties.vue').default);
Vue.component('v-modalbuht', require('./components/ModalBuht.vue').default);

Vue.component('v-ModalWarehouse', require('./components/ModalWarehouse.vue').default);
Vue.component('v-ModalEditorWarehouse', require('./components/ModalEditorWarehouse.vue').default);

Vue.component('v-selecttype', require('./components/addbuht/selecttype.vue').default);
Vue.component('v-selectthickness', require('./components/addbuht/selectthickness.vue').default);
Vue.component('v-inputdata', require('./components/addbuht/input/inputdata.vue').default);
Vue.component('v-inputprice', require('./components/addbuht/input/inputprice.vue').default);
Vue.component('v-inputweight', require('./components/addbuht/input/inputweight.vue').default);
Vue.component('v-inputwidth', require('./components/addbuht/input/inputwidth.vue').default);
Vue.component('v-selectcounterparties', require('./components/addbuht/selectcounterparties.vue').default);
Vue.component('v-selectwarehouse', require('./components/addbuht/selectwarehouse.vue').default);

import router from "./router";

const app = new Vue({
    el: '#app',
    router
});
