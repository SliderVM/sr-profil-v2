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
                <b-tr @click="load(shtrips1.id)">
                    <b-td>{{shtrips1.id}}</b-td>
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
                    <div class="container-fluid">
                        <b-table-simple bordered>
                            <b-thead>
                                <b-tr>
                                    <b-th>Складской номер</b-th>
                                    <b-th>Количество</b-th>
                                    <b-th>Дата перемещения</b-th>
                                    <b-th>Переместил:</b-th>
                                    <b-th>Подтвердил перемещение:</b-th>
                                </b-tr>
                            </b-thead>
                            <b-tbody>
                                <b-tr>
                                    <b-td>{{name}}</b-td>
                                    <b-td>{{sumShtrips}}</b-td>
                                    <b-td></b-td>
                                    <b-td></b-td>
                                    <b-td></b-td>
                                </b-tr>
                            </b-tbody>
                        </b-table-simple>
                    </div>
                </b-tr>
            </b-tbody>
            <b-tfoot>
                <b-tr>
                    <b-td colspan="8">Итого: </b-td>
                    <b-td colspan="4">{{total}}</b-td>
                </b-tr>
            </b-tfoot>
        </b-table-simple>
    </div>
</template>
<script>
import shtripsMore from '../Warehouses/ShtripsMore.vue'
export default {
    components: {shtripsMore},
    props: ['shtrips', 'val1'],
    data: () => ({
        val: '',
        visible: false,
        pipe: [],
        name: '',
        sumShtrips: ''
    }),
    computed: {
        total() {
            let a = 0;
            return this.shtrips.reduce(function (a, shtrips1) {
                return a + shtrips1.cost * shtrips1.width_in_millimeters;
            }, 0);
        }
    },
    methods: {
        load(id) {
            this.val = id;
            this.nameShtrips();
            this.loadAmount();
            this.loadHistory();
        },
        nameShtrips() {
            axios.post('shtripsnum/' + this.val)
            .then (res => {
                console.log(res);
                this.name = res.data
            })
        },
        loadAmount() {
            axios.post('groupshtrips', [this.val1, this.val])
            .then(res => {
                this.sumShtrips = res.data[0];
            });
        }
    }
}
</script>
