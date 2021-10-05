<template>
    <div class="row">
        <div class="col">
            <select v-model="complect.Form.selected" class="form-control col-3" name="sklad" @change="smena">
                <option disabled value="">Выберите склад</option>
                <option size="sm" class="mt-3" v-for="warehouse in warehouseArray" :key="warehouse.id" :value="warehouse.id">
                    {{warehouse.name}}
                </option>
            </select>
        </div>
        <div class="col">
            <select v-model="complect.Form.selectType" class="form-control col-3">
                <option value="">Выберите тип склада</option>
                <option size="sm" class="mt-3" v-for="warehouset in warehouseT.warehouse_types" :key="warehouset.id" :value="warehouset.id">
                    {{warehouset.name}}
                </option>
            </select>
        </div>
    </div>
</template>
<script>
export default {
    props: ["complect"],
    data: () => ({
        warehouseArray: [],
        options: [{ warehouseArray: '', value: '' }],
        warehouseT: {},
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        smena(event) {
            axios.get("/api/warehouse/" + event.target.value)
            .then(response => {
                this.warehouseT = response.data;
            });
        },
        loadwarehouse() {
            axios.get("/api/warehouse/create")
            .then(res => {
                this.warehouseArray = res.data;
            });
        }
    }
}
</script>
