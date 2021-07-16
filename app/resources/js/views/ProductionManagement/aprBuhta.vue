<template>
    <div>
         <b-table-simple bordered>
            <b-thead>
                <b-tr>
                    <b-th>Наименование</b-th>
                    <b-th>Контрагент</b-th>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Стоимость, руб</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for='apr in aprArray' :key='apr.id'>
                <td @click="loadA(apr.id)">{{apr.name}}</td>
                <td>{{apr.counterparties.name}}</td>
                <td>{{apr.types_metals.name}}</td>
                <td>{{apr.width}}</td>
                <td>{{apr.metal_thickness_id}}</td>
                <td>{{apr.length}}</td>
                <td>{{apr.weight}}</td>
                <td>{{apr.price}}</td>
                <aprLoad :apr="veryApr" v-if="visible"></aprLoad>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
import aprLoad from './aprLoad.vue'
export default {
    components: {aprLoad},
    data:() => ({
        aprArray: [],
        veryApr: [],
        visible: false,
    }),
    mounted() {
        this.loadApr();
    },
    methods: {
        loadApr() {
            axios.get('/api/apr')
            .then(res => {
                this.aprArray = res.data
            })
        },
        loadA(id) {
             axios.get('/api/apr/' + id)
            .then(res => {
                console.log(res.data)
                this.veryApr = res.data;
                this.visible = true;
            })
        }
    }
}
</script>

<style>

</style>
