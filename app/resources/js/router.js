import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from "./views/index.vue"
import demands from "./views/demands.vue"
import truba from "./views/truba.vue"
import shtrips from "./views/shtrips.vue"
import info from "./views/info.vue"
import info3 from "./views/info3.vue"
import info2 from "./views/info2.vue"
import info4 from "./views/info4.vue"


const routes = [
    {
        path: "/index",
        component: index
    },
    {
        path: "/demands",
        component: demands
    },
    {
        path: "/truba",
        component: truba
    },
    {
        path: "/shtrips",
        component: shtrips
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
        path: "/info4",
        component: info4
    }
];

export default new vueRouter ({
    routes:routes,
    mode: 'history'
});
