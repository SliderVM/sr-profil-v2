<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <select v-model="selected" class="form-control col-3" name="sklad" @change="smena">
                <option disabled value="">Выберите склад</option>
                <option size="sm" class="mt-3"
                v-for="warehouse in warehouseArray"
                :key="warehouse.id"
                :value="warehouse.id">
                {{warehouse.name}}
                </option>
            </select>
        </div>
        <div class="col-3">
            <select v-model="selectType" class="form-control col-3" @change="loadPage">
                <option value="">Выберите тип склада</option>
                <option size="sm" class="mt-3" v-for="warehouset in warehouseT.warehouse_types"
                :key="warehouset.id"
                :value="warehouset.id">
                {{warehouset.name}}
                </option>
            </select>
        </div>
        <br>
        <h5>История проката</h5>
        <div v-if="visible">
            <buhta :val1="val1"></buhta>
        </div>
        <div v-if="show">
            <shtrips :shtrips="shtrips" :val1="val1"></shtrips>
        </div>
    </div>
</div>
</template>

<script>
import Shtrips from '../History/Shtrips.vue';
import buhta from './buhtaHistory.vue'
export default {
    components: {buhta, Shtrips},
    data: () => ({
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        warehouseT: {},
        selectType: '',
        selected: '',
        visible: true,
        shtripsArray: [],
        val1: '',
        aprArray: [],
        buhtaArray: [],
        show: false,
        shtrips: []
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        loadShtrips() {
            axios.get('shtripshistory/' + this.val1)
            .then(res => {
                this.shtrips = res.data
            })
        },
        smena(event) { // событие первого селекта, выбрать склад
            axios.get('/api/warehouse/' + event.target.value)
            .then((response) => {
                this.warehouseT = response.data
                this.val1 = event.target.value
                this.selectType = ''
                this.visible = false;
            })
        },
        loadwarehouse() { // загрузка складов
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        loadPage(event) { // событие второго селекта, выбрать тип склада
           if(event.target.value == "") {
                this.show = false;
                this.visible = false;
            }
            else if (event.target.value == 1) {
                this.show = false;
                this.visible = true;
                this.loadBuhtWarehouse();
            }
            else
            {
                this.loadShtrips();
                this.visible = false;
                this.show = true;
            }
        }
    }
}
</script>
