<template>
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
            <select class="form-control col-3" name="type" @change="loadPage">
                <option disabled value="" selected>Выберите тип склад</option>
                <option size="sm" class="mt-3" v-for="warehouset in warehouseT.warehouse_types"
                :key="warehouset.id"
                :value="warehouset.table_name">
                {{warehouset.name}}
                </option>
            </select>
        </div>
    <h5> Управление производством </h5>
        <div class="hidden" v-show="visible">
            <buhta></buhta>
        </div>
  </div>
</template>

<script>
import buhta from './aprBuhta.vue';
export default {
    components: {buhta},
    data: () => ({
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        warehouseT: {},
        selected: '',
        visible: false
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        smena(event) {
            axios.get('/api/warehouse/' + event.target.value)
            .then((response) => {
                this.warehouseT = response.data
            });
        },
        loadwarehouse() {
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        loadPage(event) {
            this.visible=true

            console.log(event.target.value);
        },
    }
}
</script>
