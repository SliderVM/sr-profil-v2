<template>
    <div class="hidden" v-if="visible">
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
           <b-tbody v-for="buhta in aprArray" :key="buhta.id">
                <b-tr @click="loadA(buhta.id)">
                    <b-td>{{buhta.name}}</b-td>
                    <b-td>{{buhta.counterparties.name}}</b-td>
                    <b-td>{{buhta.types_metals.name}}</b-td>
                    <b-td>{{buhta.width}}</b-td>
                    <b-td>{{buhta.metal_thicknesse.thicknesses}}</b-td>
                    <b-td>{{buhta.length}}</b-td>
                    <b-td>{{buhta.weight}}</b-td>
                    <b-td>{{buhta.price}}</b-td>
                    <div class='btn-group'>
                        <shtrips-modal :buhta="aprArray" :apr="aprs"></shtrips-modal>
                        <print :buhta="aprArray"></print>
                    </div>
                </b-tr>
                <b-tr class="hidden" v-if="buhta.id === aprId">
                    <aprLoad :apr="aprs"></aprLoad>
                </b-tr>
           </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
import print from '../../components/productionComponents/Print.vue'
import shtripsModal from '../../components/productionComponents/shtripsModal.vue'
import aprLoad from './aprLoad.vue'
export default {
    props: ["warehouseKey"],
    components: {aprLoad, shtripsModal, print},
    data:() => ({
        aprArray: [],
        aprs: [],
        aprId: '',
        visible: false,
        modalShow: false,
    }),
    mounted() {
        this.loadApr();
    },
    methods: {
        loadApr() {
            axios.get('/api/buhtas/' + this.warehouseKey) // получить бухты по айди склада
            .then(res => {
                this.aprArray = res.data
                if (res.data.length ) {
                    this.visible = true
                }
                else {
                    alert('Нет бухт с АПР');
                    this.visible = false
                }
            })
        },
        loadA(id) { // получить апр по айди бухты
            axios.get('/api/apr/' + id)
            .then(res => {
                this.aprs = res.data;
                this.aprId = id;
            })
        }
    }
}
</script>
