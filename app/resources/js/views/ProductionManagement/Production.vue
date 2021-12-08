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
        <div v-if="visible">
            <buhta :warehouseKey="val1"></buhta>
        </div>
        <div v-if="show">
            <pipe></pipe>
        </div>
    </div>
</div>
</template>

<script>
import buhta from './aprBuhta.vue';
import pipe from './pipe.vue'
export default {
    components: {buhta, pipe},
    data: () => ({
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        warehouseT: {},
        selected: '',
        selectType: '',
        visible: false,
        show: false,
        val1: ''
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        smena(event) {
            axios.get('/api/warehouse/' + event.target.value)
            .then((response) => {
                this.warehouseT = response.data
                this.val1 = event.target.value
                this.selectType = ''
            });
        },
        loadwarehouse() {
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        loadPage(event) {
            if(event.target.value == 1) {
                this.visible = true
            }
            else {
                this.show = true;
                this.visible = false;
            }
        }
    }
}
</script>
