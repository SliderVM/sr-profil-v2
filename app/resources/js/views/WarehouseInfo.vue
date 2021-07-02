<template>
    <div class="container-fluid">
            <h5 class="mb-3">Справочники</h5>
                <div class="row">
                    <div class="col-3">
                        <div class="list-group small">
                            <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}} </router-link>
                        </div>
                    </div>
                    <div class="col-9">
                        <h2 class="mb-3">Склады</h2>
                            <v-ModalWarehouse></v-ModalWarehouse>
                        <table class="table mt-9">
                            <thead>
                                <tr>
                                    <th>Наименование склада</th>
                                    <th>Тип склада</th>
                                    <th>Операции</th>
                                </tr>
                            </thead>
                            <tbody>
                                <warehouse v-for="Warehouse in Warehouses"
                                :key="Warehouse.id"
                                :Warehouse="Warehouse"/>

                                <v-Warehouse></v-Warehouse>
                            </tbody>

                        </table>
                    </div>
                </div>
    </div>
</template>

<script>
import axios from 'axios';
import  Warehouse from '../components/Warehouse.vue'
export default {
    components: {Warehouse},
    data: () => ({
        Warehouses: [],
        links: [
                    {
                        title: "Тип металла",
                        href:"/info"
                    },
                    {
                        title: "Размеры труб",
                        href:"/info2"
                    },
                    {
                        title: "Толщина металла",
                        href:"/info5"
                    },
                    {
                        title: "Управление складами",
                        href:"/warehouseinfo"
                    },
        ]
    }),
    mounted() {
        this.loadWarehouse();
    },
    methods: {
        loadWarehouse() {
            axios.get('/api/warehouse/create')
            .then(res => {
                this.Warehouses = res.data;
            })
        },
    }
}
</script>
