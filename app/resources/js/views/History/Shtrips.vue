<template>
    <div>
        <b-table-simple>
            <b-thead>
                <b-tr>
                    <b-th>Тип</b-th>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Цена за тонну</b-th>
                    <b-th>Сумма</b-th>
                    <b-th>Размер трубы</b-th>
                    <b-th>Прогноз, тн</b-th>
                    <b-th></b-th>
                </b-tr>
            </b-thead>
            <b-tbody v-for="shtrips1 in shtrips" :key="shtrips1.id">
                <b-tr @click="load(shtrips1.strips_id)" :variant="shtrips1.outgoing_warehouse_id == shtrips1.warehouse_id ? 'success' : 'danger'">
                    <b-td>{{shtrips1.outgoing_warehouse_id == shtrips1.warehouse_id ? 'Приход' : 'Расход'}} {{ shtrips1.dateSending }}</b-td>
                     <!-- если не получен то не видно, если отправлен то дата отправки, если получен то дата получения -->
                    <b-td>{{shtrips1.types_metals.name}}</b-td>
                    <b-td>{{shtrips1.width_in_millimeters}}</b-td>
                    <b-td>{{shtrips1.metal_thicknesse.thicknesses}}</b-td>
                    <b-td>{{shtrips1.length_in_meters}}</b-td>
                    <b-td>{{shtrips1.weight_in_tons}}</b-td>
                    <b-td>{{shtrips1.cost}}</b-td>
                    <b-td>{{shtrips1.cost * shtrips1.width_in_millimeters || 0}}</b-td>
                    <b-td>{{shtrips1.pipe_type.name}}</b-td>
                    <b-td>{{shtrips1.pipe_type.coefficient * (sumShtrips * shtrips1.width_in_millimeters)}}</b-td>
                    <b-td>
                        <div class='btn-group'>
                            <b-button size="sm" variant='outline-dark' class="mr-2"> Откатить прокат
                            </b-button>
                        </div>
                    </b-td>
                </b-tr>
                <b-tr v-if="shtrips1.strips_id === val">
                    <div class="container-fluid">
                        <b-table-simple>
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
                                    <b-td >{{sumShtrips}}</b-td>
                                    <b-td>{{shtrips1.date_receipt}}</b-td>
                                    <b-td>{{sendUser}}</b-td>
                                    <b-td>{{recUser}}</b-td>
                                </b-tr>
                            </b-tbody>
                        </b-table-simple>
                    </div>
                </b-tr>
            </b-tbody>
            <b-tfoot>
                <b-tr>
                    <b-td colspan="8">Итого: </b-td>
                    <b-td colspan="4">{{total.toFixed(2)}}</b-td>
                </b-tr>
            </b-tfoot>
        </b-table-simple>
    </div>
</template>
<script>
import shtripsMore from '../Warehouses/ShtripsMore.vue'
export default {
    components: {shtripsMore},
    props: [ 'wID'],
    data: () => ({
        val: '',
        visible: false,
        pipe: [],
        name: '',
        sumShtrips: '',
        shtrips: [],
        recUser: '',
        sendUser: ''
    }),
    computed: {
        total() {
            let a = 0;
            return this.shtrips.reduce(function (a, shtrips1) {
                return a + shtrips1.cost * shtrips1.width_in_millimeters;
            }, 0);
        }
    },
    mounted(){
        this.loadShtrips();
    },
    methods: {
        load(id) {
            this.val = id;
            this.nameShtrips();
            this.loadAmount();
        },
        nameShtrips() {
            axios.post('shtripsnum/' + this.val)
            .then (res => {
                this.name = res.data
            })
        },
        loadAmount() {
            axios.post('groupshtrips', [this.wID, this.val])
            .then(res => {
                this.sumShtrips = res.data[0];
            });
        },
        loadShtrips() {
            axios.get('shtripshistory/' + this.wID)
            .then(res => {
                this.shtrips = res.data[0];
                this.sendUser = res.data[1];
                this.recUser = res.data[2];
            })
        },
    }
}
</script>
