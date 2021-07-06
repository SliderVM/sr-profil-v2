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
                            <v-ModalWarehouse @send="WarehouseNew" ></v-ModalWarehouse>
                        <table class="table mt-9">
                            <thead>
                                <tr>
                                    <th>Наименование склада</th>
                                    <th>Тип склада</th>
                                    <th class="col-4">Операции</th>
                                </tr>
                            </thead>
                            <tbody>
                                <warehouse v-for="Warehouse in Warehouses"
                                :key="Warehouse.id"
                                :Warehouse="Warehouse" @removeWarehouse="removing" @editWarehouse="editor"/>
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
        Form: {},
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
        WarehouseNew(data) {
                this.form = data.Form
                this.Warehouses.push(this.Form);
        },
        editor() {
            this.Warehouses.splice(0, this.Form);
        },
        removing(id) {
            const index = this.Warehouses.findIndex(W => W.id === id)
            this.Warehouses.splice(index,1)
        },

    }
}
</script>
