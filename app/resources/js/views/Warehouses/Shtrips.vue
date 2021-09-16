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
                <b-tr @click="truba(shtrips1.id)">
                    <b-td >{{shtrips1.types_metals.name}}</b-td>
                    <b-td>{{shtrips1.width_in_millimeters}}</b-td>
                    <b-td>{{shtrips1.metal_thicknesse.thicknesses}}</b-td>
                    <b-td>{{shtrips1.length_in_meters}}</b-td>
                    <b-td>{{shtrips1.weight_in_tons}}</b-td>
                    <b-td>{{shtrips1.cost}}</b-td>
                    <b-td>{{shtrips1.cost * shtrips1.width_in_millimeters || 0}}</b-td>
                    <b-td>{{shtrips1.pipe_type.name}}</b-td>
                    <b-td>{{shtrips1.pipe_type.coefficient * (sumShtrips * shtrips1.width_in_millimeters)}}</b-td>
                </b-tr>
                <b-tr class="hidden" v-if="shtrips1.id === val">
                    <shtripsMore :wId="wId" :val="val" :name="name"></shtripsMore>
                </b-tr>
            </b-tbody>
            <b-tfoot>
                <b-tr>
                    <b-td colspan="6">Итого: </b-td>
                    <b-td colspan="5">{{total}}</b-td>
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
    props: ['shtrips', 'wId'],
    data: () => ({
        val: '',
        visible: false,
        pipe: [],
        name: '',
        sumShtrips: ''
    }),
    computed: {
        total: function() {
            let a = 0;
            return this.shtrips.reduce(function (a, shtrips1) {
                return a + shtrips1.cost * shtrips1.width_in_millimeters;
            }, 0);
        }
    },
    methods: {
        truba(id) {
            this.val = id;
            this.nameShtrips();
            this.loadAmount();
        },
        nameShtrips() {
            axios.post('shtripsnum/' + this.val)
            .then (res => {
                console.log(res);
                this.name = res.data
            })
        },
        loadAmount() {
            axios.post('groupshtrips', [this.wId, this.val])
            .then(res => {
                this.sumShtrips = res.data[0];
            });
        }
    }
}
</script>
