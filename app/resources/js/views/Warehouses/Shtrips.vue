<template>
    <div>
        <b-table-simple bordered>
            <b-thead>
                <b-tr>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Цена за тонну</b-th>
                    <b-th>Сумма</b-th>
                    <b-th>Размер трубы</b-th>
                    <b-th>Прогноз, тн</b-th>
                </b-tr>
            </b-thead>
            <b-tbody v-for="shtrips1 in shtrips" :key="shtrips1.id">
                <b-tr @click="te(shtrips1.id)">
                    <b-td >{{shtrips1.types_metals.name}}</b-td>
                    <b-td>{{shtrips1.width_in_millimeters}}</b-td>
                    <b-td>{{shtrips1.metal_thicknesse.thicknesses}}</b-td>
                    <b-td>{{shtrips1.length_in_meters}}</b-td>
                    <b-td>{{shtrips1.weight_in_tons}}</b-td>
                    <b-td>{{shtrips1.cost}}</b-td>
                    <b-td>{{sum}}</b-td>
                    <b-td>{{pipe.name}}</b-td>
                    <b-td>{{shtrips1.name}}</b-td>
                </b-tr>
                <b-tr class="hidden" v-if="shtrips1.id === val">
                    <shtripsMore :id="wId"  :val="val" :name="name"></shtripsMore>
                </b-tr>
            </b-tbody>
            <b-tfoot>
                <b-tr class="font-weight-bold">
                    <b-td colspan="7">Итого: </b-td>
                    <b-td colspan="4">{{total}}</b-td>
                </b-tr>
            </b-tfoot>
        </b-table-simple>
    </div>
</template>
<script>
// сделать итого как сумма всех штрипсов + прогноз тн: общая длина штрипса одного типа(!) * коэффициент трубы
import shtripsMore from '../Warehouses/ShtripsMore.vue'
export default {
    components: {shtripsMore},
    name: "shtrips",
    props: ['shtrips', 'wId'],
    data: () => ({
        shtripsArray: [],
        sum: '',
        val: '',
        visible: false,
        pipe: [],
        total: '',
        name: ''
    }),
    methods: {
        te(id) {
            axios.get("/api/pipetype/" + id)
            .then(res => {
                this.pipe = res.data[0]
                this.sum = res.data[1];
                this.val = id;
                this.nameShtrips();
            });
        },
        nameShtrips() {
            axios.post('shtripsnum/' + this.val)
            .then (res => {
                console.log(res);
                this.name = res.data
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
