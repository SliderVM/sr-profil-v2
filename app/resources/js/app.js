require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

Vue.component('v-header', require('./components/header.vue').default);
Vue.component('login', require('./views/Auth/Login.vue').default);

Vue.component('v-buhta', require('./components/buhta.vue').default);
Vue.component('v-aprModal', require('./components/aprModal.vue').default);
Vue.component('v-types', require('./components/types.vue').default);
Vue.component('v-Warehouse', require('./components/Warehouse.vue').default);
Vue.component('v-thicknesse', require('./components/thicknesse.vue').default);
Vue.component('v-counterparties', require('./components/counterparties.vue').default);
Vue.component('v-brigadeTable', require('./components/brigade/brigadeTable.vue').default);
Vue.component('v-modalAdd', require('./components/brigade/modalBrigadeAdd.vue').default);
Vue.component('v-modalEditor', require('./components/brigade/brigadeEditor.vue').default);
Vue.component('v-modalbuht', require('./components/ModalBuht.vue').default);
Vue.component('v-ModalWarehouse', require('./components/ModalWarehouse.vue').default);
Vue.component('v-ModalEditorWarehouse', require('./components/ModalEditorWarehouse.vue').default);
Vue.component('v-ModalBuhtaEditor', require('./components/ModalBuhtaEditor.vue').default);


Vue.component('v-selecttype', require('./components/addbuht/selecttype.vue').default);
Vue.component('v-selectthickness', require('./components/addbuht/selectthickness.vue').default);
Vue.component('v-SelectCounterparties', require('./components/addbuht/SelectCounterparties.vue').default);
Vue.component('v-selectwarehouse', require('./components/addbuht/selectwarehouse.vue').default);
Vue.component('v-inputname', require('./components/addbuht/input/inputName.vue').default);
Vue.component('v-InputData', require('./components/addbuht/input/InputData.vue').default);
Vue.component('v-InputPrice', require('./components/addbuht/input/InputPrice.vue').default);
Vue.component('v-InputWeight', require('./components/addbuht/input/InputWeight.vue').default);
Vue.component('v-InputWidth', require('./components/addbuht/input/InputWidth.vue').default);
Vue.component('v-buhtaApr', require('./views/ProductionManagement/buhtaOutput.vue').default);


import router from "./router";

const app = new Vue({
    el: '#app',
    router
});
