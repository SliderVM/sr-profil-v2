<template>
<div>
    <label>На склад</label>
    <br>
    <select v-model="warehouse_id" @change="selectWarehouse">
        <option size="sm" class="mt-3"  v-for="warehouse in warehouseArray" :key="warehouse.message" :value="warehouse.name">{{warehouse.name}} </option>
    </select>
</div>
</template>

<script>
export default {
    props: ['war'],
    data: () => ({
        selected: '',
        warehouse_id: '',
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ]
    }),
    mounted() {
        this.loadwarehouse();
        
    },
    methods: {
        loadwarehouse() {
            axios.get('/api/warehouse')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        selectWarehouse() {
            this.$emit('selectWarehouse', {selected: this.warehouse_id})
        }
    }
}
</script>
