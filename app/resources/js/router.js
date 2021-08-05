import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import buhtas from "./views/buhtas.vue"
import demands from "./views/demands.vue"
import info from "./views/info.vue"
import info3 from "./views/info3.vue"
import info2 from "./views/info2.vue"
import info5 from "./views/info5.vue"
import WarehouseInfo from "./views/WarehouseInfo.vue"
import ModalEditorWarehouse from "./components/ModalEditorWarehouse.vue"
import Production from "./views/ProductionManagement/Production.vue"
import Brigade from "./views/Brigade.vue"
import Login from "./views/Auth/Login.vue"
import user from "./views/Users.vue"

const routes = [
    {
        path: "/",
        component: buhtas,
        name: 'home'
    },
    {
        path: "/buhtas",
        component: buhtas
    },
    {
        path: "/demands",
        component: demands
    },
    {
        path: "/productionmanagement",
        component: Production
    },
    {
        path: "/info",
        component: info
    },
    {
        path: "/info3",
        component: info3
    },
    {
        path: "/info2",
        component: info2
    },
    {
        path: "/info5",
        component: info5
    },
    {
        path: "/warehouseinfo",
        component: WarehouseInfo
    },
    {
        path: "/warehousetype/:id",
        component: ModalEditorWarehouse
    },
    {
        path: "/brigade",
        component: Brigade
    },
    {
        path: "/login",
        component: Login,
        name: 'login',
    },
    {
        path: "/users",
        component: user
    }
];

export default new vueRouter ({
    routes: routes,
    mode: 'history'
});

