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
            <tbody v-for="buhta in aprArray" :key="buhta.id">
                <tr>
                    <td @click="loadA(buhta.id)">{{buhta.name}}</td>
                    <td>{{buhta.counterparties.name}}</td>
                    <td>{{buhta.types_metals.name}}</td>
                    <td>{{buhta.width}}</td>
                    <td>{{buhta.metal_thicknesse.thicknesses}}</td>
                    <td>{{buhta.length}}</td>
                    <td>{{buhta.weight}}</td>
                    <td>{{buhta.price}}</td>
                </tr>
                <tr class="hidden" v-if="buhta.id === visible">
                    <aprLoad :apr="aprs"></aprLoad>
                </tr>
            </tbody>
        </b-table-simple>
    </div>
</template>

<script>
import aprLoad from './aprLoad.vue'
export default {
    components: {aprLoad},
    data:() => ({
        aprArray: [],
        aprs: [],
        visible: '',
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
            console.log();
            axios.get('/api/apr/' + id)
            .then(res => {
                console.log(res.data);
                this.aprs = res.data;
                this.visible = id;
                 console.log( this.visible);
            })
        }
    }
}
</script>

<style>

</style>
